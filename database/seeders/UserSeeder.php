<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory(1)->create([
            'name' => 'Admin',
            'email' => 'admin@ucc.mx',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        User::factory(1)->create([
            'name' => 'User',
            'email' => 'user@ucc.mx',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        User::factory(10)->create();
    }
}
