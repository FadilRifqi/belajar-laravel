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
        $divisions = ['IT', 'HRD', 'Marketing'];
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
            'Alexander'
        ]; // 20 real names
        $users = [
            [
                'name' => 'Admin',
                'password' => Hash::make('password'), // Consider using a more secure password in production
                'role_id' => 1, // Assuming role_id 1 is for Admin
                'divisi' => 'Admin', // Admin division
            ],
        ];
        foreach ($names as $index => $name) {
            $divIndex = $index % count($divisions); // Cycle through the divisions array
            $users[] = [
                'name' => $name,
                'password' => Hash::make('password'),
                'role_id' => 2, // Assuming role_id 2 for simplicity
                'divisi' => $divisions[$divIndex], // Assign division from the divisions array
            ];
        }

        User::query()->insert($users);
    }
}
