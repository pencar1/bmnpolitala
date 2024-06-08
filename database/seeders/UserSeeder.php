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
            'nama'          => 'admin',
            'prodi'         => '',
            'nim'           => '',
            'nohp'          => '08000000000',
            'organisasi'    => 'bmn',
            'email'         => 'admin@gmail.com',
            'password'      => Hash::make('admin123'),
            'role'          => 'admin',
        ]);

        User::create([
            'nama'          => 'Nico',
            'prodi'         => '',
            'nim'           => '',
            'nohp'          => '08111111111',
            'organisasi'    => 'bmn',
            'email'         => 'nico@gmail.com',
            'password'      => Hash::make('inipassword'),
            'role'          => 'admin',
        ]);

        User::create([
            'nama'          => 'John',
            'prodi'         => '',
            'nim'           => '',
            'nohp'          => '0822222222',
            'organisasi'    => 'bmn',
            'email'         => 'john@gmail.com',
            'password'      => Hash::make('password123'),
            'role'          => 'staf',
        ]);

        User::create([
            'nama'          => 'Novianto',
            'prodi'         => '',
            'nim'           => '',
            'nohp'          => '0833333333',
            'organisasi'    => 'bmn',
            'email'         => 'novianto@gmail.com',
            'password'      => Hash::make('inipassword123'),
            'role'          => 'staf',
        ]);

        User::create([
            'nama'          => 'kurdi',
            'prodi'         => 'Teknologi Informasi',
            'nim'           => '2201301099',
            'nohp'          => '084444444444',
            'organisasi'    => 'bem',
            'email'         => 'kurdi@gmail.com',
            'password'      => Hash::make('12345678'),
            'role'          => 'peminjam',
        ]);

        User::create([
            'nama'          => 'Muhammad',
            'prodi'         => 'Agroindustri',
            'nim'           => '2203301099',
            'nohp'          => '08555555555',
            'organisasi'    => 'dpm',
            'email'         => 'muhammad@gmail.com',
            'password'      => Hash::make('muhammad'),
            'role'          => 'peminjam',
        ]);
    }
}
