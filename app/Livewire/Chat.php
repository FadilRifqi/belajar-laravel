<?php

namespace App\Livewire;

use Livewire\Component;

class Chat extends Component
{
    public $message = '';
    public $user = null;
    public function mount()
    {
        $this->user = auth()->user();
        $this->message = 'Hello World';
    }

    public function getListeners()
    {
        return [
            "echo:chat.{$this->user->id},MessageSent" => 'newMessage',
        ];
    }

    public function newMessage($payload)
    {
        $this->message = $payload['message'];
    }
    public function render()
    {
        return view('livewire.chat')->layout('layout.client.app');
    }
}
