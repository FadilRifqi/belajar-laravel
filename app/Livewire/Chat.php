<?php

namespace App\Livewire;

use App\Events\MessageSent;
use App\Models\Conversation;
use App\Models\ConversationUser;
use App\Models\Message;
use Livewire\Attributes\On;
use Livewire\Component;

class Chat extends Component
{
    public $messages = [];
    public $user = null;
    public $body = '';
    public $divisi_name = null;
    public $conversation = null;

    public function mount($divisi_name)
    {
        $this->user = auth()->user();
        $this->conversation = Conversation::firstOrCreate([
            'nama' => $divisi_name,
        ]);
        $this->divisi_name = $divisi_name;
        $this->messages = Message::where('conversation_id', $this->conversation->id)->get();
    }

    public function getListeners()
    {
        return [
            "echo:chat.{$this->conversation->id},.message-sent" => 'newMessageReceived',
        ];
    }
    public function newMessageReceived($data)
    {
        $this->messages = Message::where('conversation_id', $this->conversation->id)->get();
    }
    public function makeNewMessage()
    {
        try {
            if ($this->body == '') {
                return;
            }
            //TODO: change conversation name dynamically
            $conversation = Conversation::firstOrCreate([
                'nama' => $this->user->divisi->nama,
            ]);
            $conversation_user = ConversationUser::firstOrCreate([
                'conversation_id' => $conversation->id,
                'user_id' => $this->user->id
            ]);
            $message = Message::create([
                'user_id' => $this->user->id,
                'conversation_id' => $conversation->id,
                'body' => $this->body
            ]);
            $this->body = "";
            $this->messages = Message::where('conversation_id', $this->conversation->id)->get();
            MessageSent::dispatch($this->conversation->id);
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.chat')->extends('layout.client.app')->section('content');
    }
}
