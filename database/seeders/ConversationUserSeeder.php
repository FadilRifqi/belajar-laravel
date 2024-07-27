<?php

namespace Database\Seeders;

use App\Models\Conversation;
use App\Models\ConversationUser;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConversationUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $conversations = Conversation::all()->keyBy('nama');
        $users = User::with('divisi')->get();

        $conversationUsers = [];

        foreach ($users as $user) {
            $divisiName = $user->divisi->nama;
            if (isset($conversations[$divisiName])) {
                $conversationUsers[] = [
                    'conversation_id' => $conversations[$divisiName]->id,
                    'user_id' => $user->id,
                ];
            }
        }

        ConversationUser::query()->insert($conversationUsers);
    }
}
