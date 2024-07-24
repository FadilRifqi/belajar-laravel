<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $divisions = [2, 3, 4, 5, 6, 7, 8, 9, 10]; // 10 divisions
        $names = [
            'Emma',
            'Liam',
            'Olivia',
            'Noah',
            'Ava',
            'Oliver',
            'Isabella',
            'Elijah',
            'Sophia',
            'William',
            'Mia',
            'James',
            'Charlotte',
            'Benjamin',
            'Amelia',
            'Lucas',
            'Harper',
            'Henry',
            'Evelyn',
            'Alexander',
            'Abigail',
            'Michael',
            'Emily',
            'Daniel',
            'Elizabeth',
            'Matthew',
            'Sofia',
            'Aiden',
            'Avery',
            'Joseph',
            'Ella',
            'Jackson',
            'Scarlett',
            'David',
            'Grace',
            'Gracia',
            'Chloe',
            'Carter',
            'Victoria',
            'Ethan',
            'Riley',
            'Sebastian',

        ]; // 
        $users = [
            [
                'name' => 'Admin',
                'nip' => '1234567890',
                'password' => Hash::make('password'), // Consider using a more secure password in production
                'role_id' => 1, // Assuming role_id 1 is for Admin
                'divisi_id' => 1, // Admin division
            ],
        ];
        foreach ($names as $index => $name) {
            $divIndex = $index % count($divisions); // Cycle through the divisions array
            $users[] = [
                'name' => $name,
                'nip' => substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 10),
                'password' => Hash::make('password'),
                'role_id' => 2, // Assuming role_id 2 for simplicity
                'divisi_id' => $divisions[$divIndex], // Assign division from the divisions array
            ];
        }

        User::query()->insert($users);
    }
}
