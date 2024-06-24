<?php

namespace Database\Seeders;

use App\Models\Ruangan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ruangan::create([
            'namaruangan'       => 'Ruang Kelas',
            'deskripsiruangan'   => 'Muat 50 kursi',
            'foto'              => '1717837002_kelas.jpg',
        ]);

        Ruangan::create([
            'namaruangan'       => 'Ruang Kelas',
            'deskripsiruangan'   => 'Muat 50 kursi',
            'foto'              => '1717836865_ruang kelas.png',
        ]);

        Ruangan::create([
            'namaruangan'       => 'Ruang Aula Lantai Dasar',
            'deskripsiruangan'   => 'Muat 250 kursi',
            'foto'              => '1717836878_aula.jpg',
        ]);

        Ruangan::create([
            'namaruangan'       => 'Ruang Lab Komputer',
            'deskripsiruangan'   => 'Muat 30 kursi',
            'foto'              => '1717836894_lab kom.jpg',
        ]);

        Ruangan::create([
            'namaruangan'       => 'Ruang Lab Komputer',
            'deskripsiruangan'   => 'Muat 30 kursi',
            'foto'              => '1717839174_lab komputer.jpg',
        ]);

        Ruangan::create([
            'namaruangan'       => 'Ruang Kelas',
            'deskripsiruangan'   => 'Muat 50 kursi',
            'foto'              => '1717839023_classroom.jpg',
        ]);

        Ruangan::create([
            'namaruangan'       => 'Ruang Aula GKT Lantai 1',
            'deskripsiruangan'   => 'Muat 250 kursi',
            'foto'              => '1718447162_aula gkt lantai 1.jpg',
        ]);
    }
}
