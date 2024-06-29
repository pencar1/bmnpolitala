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
            'stokruangan'       => '1',
            'deskripsiruangan'  => 'Muat 50 kursi',
            'foto'              => 'kelas.jpg',
        ]);

        Ruangan::create([
            'namaruangan'       => 'Ruang Kelas',
            'stokruangan'       => '1',
            'deskripsiruangan'  => 'Muat 50 kursi',
            'foto'              => 'ruang kelas.png',
        ]);

        Ruangan::create([
            'namaruangan'       => 'Ruang Aula Lantai Dasar',
            'stokruangan'       => '1',
            'deskripsiruangan'  => 'Muat 250 kursi',
            'foto'              => 'aula.jpg',
        ]);

        Ruangan::create([
            'namaruangan'       => 'Ruang Lab Komputer',
            'stokruangan'       => '1',
            'deskripsiruangan'  => 'Muat 30 kursi',
            'foto'              => 'lab kom.jpg',
        ]);

        Ruangan::create([
            'namaruangan'       => 'Ruang Lab Komputer',
            'stokruangan'       => '1',
            'deskripsiruangan'  => 'Muat 30 kursi',
            'foto'              => 'lab komputer.jpg',
        ]);

        Ruangan::create([
            'namaruangan'       => 'Ruang Kelas',
            'stokruangan'       => '1',
            'deskripsiruangan'  => 'Muat 50 kursi',
            'foto'              => 'classroom.jpg',
        ]);

        Ruangan::create([
            'namaruangan'       => 'Ruang Aula GKT Lantai 1',
            'stokruangan'       => '1',
            'deskripsiruangan'  => 'Muat 250 kursi',
            'foto'              => 'aula gkt lantai 1.jpg',
        ]);
    }
}
