<?php

namespace App\Livewire;

use App\Events\MessageSent;
use App\Models\Conversation;
use App\Models\ConversationUser;
use App\Models\Message;
use App\Models\User;
use Livewire\WithFileUploads;
use Livewire\Component;

class Chat extends Component
{
    use WithFileUploads;
    public $messages = [];
    public $user = null;
    public $users = [];
    public $body = '';
    public $divisi_name = null;
    public $conversation_users = null;
    public $conversation = null;
    public $conversation_active = null;
    public $file = null;
    public $imageExtensions = ["jpg", "jpeg", "png", "gif", "webp", "bmp", "svg"];


    public function mount()
    {
        $this->user = auth()->user();
        $this->users = User::where('divisi_id', $this->user->divisi_id)->get();
        $this->conversation_users = ConversationUser::where('user_id', $this->user->id)->get();
        $this->divisi_name = $this->user->divisi->nama;
    }

    public function getListeners()
    {
        $channels = [];
        foreach ($this->conversation_users as $conversation_user) {
            if (isset($conversation_user->conversation) && isset($conversation_user->conversation->id)) {
                $channels["echo:chat.{$conversation_user->conversation->id},.message-sent"] = "newMessageReceived";
            }
        }

        return $channels;
    }
    public function newMessageReceived($data)
    {
        $this->messages = Message::where('conversation_id', $data["conversation_id"])->get();
    }
    public function makeNewMessage()
    {
        try {
            if ($this->body == '' && $this->file == null) {
                return;
            }

            $filePath = null;

            if ($this->file) {
                $this->file->store('public');
                $filePath = $this->file->hashName();
            }

            $conversation_user = ConversationUser::firstOrCreate([
                'conversation_id' => $this->conversation->id,
                'user_id' => $this->user->id
            ]);
            $message = Message::create([
                'user_id' => $this->user->id,
                'conversation_id' => $this->conversation->id,
                'body' => $this->body,
                'file_path' => $filePath,
            ]);
            $this->body = "";
            $this->file = null;
            $this->messages = Message::where('conversation_id', $this->conversation->id)->get();
            MessageSent::dispatch($this->conversation->id);
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
    public function changeConversation($conversation_id)
    {
        $this->conversation = Conversation::find($conversation_id);
        $this->conversation_active = $conversation_id;
        $this->messages = Message::where('conversation_id', $conversation_id)->get();
    }
    public function createConversation($id)
    {
        $rekan = User::findOrFail($id);
        $conversation = Conversation::where('nama', $rekan->name . ' & ' . $this->user->name)->orWhere('nama', $this->user->name . ' & ' . $rekan->name)->first();
        if ($conversation) {
            return;
        }
        $conversation = Conversation::create([
            'nama' => $rekan->name . ' & ' . $this->user->name,
        ]);
        ConversationUser::firstOrCreate([
            'conversation_id' => $conversation->id,
            'user_id' => $rekan->id
        ]);
        ConversationUser::firstOrCreate([
            'conversation_id' => $conversation->id,
            'user_id' => $this->user->id
        ]);
        $this->conversation_users = ConversationUser::where('user_id', $this->user->id)->get();
        $this->conversation = $conversation;
    }

    public function removeFile()
    {
        $this->file = null;
    }
    public function render()
    {
        return view('livewire.chat')->extends('layout.client.app')->section('content');
    }
}
