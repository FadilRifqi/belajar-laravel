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
    public $message = '';
    public $user = null;
    public function mount()
    {
        $this->user = auth()->user();
        $this->message = 'Hello World';
        MessageSent::dispatch($this->user, "testing", $this->user);
    }

    public function getListeners()
    {
        return [
            "echo:chat.{$this->user->id},.message-sent" => 'newMessageReceived',
        ];
    }
    public function newMessageReceived($data)
    {
        $this->message = $data['message'];
    }
    public function makeNewMessage()
    {
        try {
            if ($this->message == '') {
                return;
            }
            //TODO: change conversation name dynamically
            $conversation = Conversation::firstOrCreate([
                'nama' => $this->user->name . ' - Admin',
            ]);
            $conversation_user = ConversationUser::firstOrCreate([
                'conversation_id' => $conversation->id,
                'user_id' => $this->user->id
            ]);
            $message = Message::create([
                'user_id' => $this->user->id,
                'conversation_id' => $conversation->id,
                'body' => $this->message
            ]);
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.chat')->extends('layout.client.app')->section('content');
    }
}
