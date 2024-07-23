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
        $users = [
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'role_id' => 1,
            ],
            [
                'name' => 'John',
                'password' => Hash::make('password'),
                'role_id' => 2,
            ],
            [
                'name' => 'Peter',
                'password' => Hash::make('password'),
                'role_id' => 2,
            ],
            [
                'name' => 'Jane',
                'password' => Hash::make('password'),
                'role_id' => 2,
            ],
        ];
        User::query()->insert($users);
    }
}
