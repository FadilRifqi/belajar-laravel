<?php

namespace Database\Seeders;

use App\Models\Conversation;
use App\Models\Divisi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConversationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $divisi = Divisi::all();
        foreach ($divisi as $d) {
            Conversation::create([
                'nama' => $d->nama,
            ]);
        }
    }
}
