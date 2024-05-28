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
        User::create([
            'name'      => 'Nico',
            'email'      => 'nico@gmail.com',
            'password'  => Hash::make('inipassword'),
        ]);

        User::create([
            'name'      => 'John',
            'email'     => 'john@example.com',
            'password'  => Hash::make('password123'),
        ]);

        User::create([
            'name'      => 'Novianto',
            'email'     => 'novianto@example.com',
            'password'  => Hash::make('inipassword123'),
        ]);
    }
}
