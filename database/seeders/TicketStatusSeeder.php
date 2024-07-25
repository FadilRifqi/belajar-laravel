<?php

namespace Database\Seeders;

use App\Models\TicketStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $status = [
            ['status_name' => 'Open'],
            ['status_name' => 'In Progress'],
            ['status_name' => 'Closed'],
        ];

        TicketStatus::query()->insert($status);
    }
}
