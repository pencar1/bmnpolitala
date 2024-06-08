<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Barang::create([
            'namabarang'        => 'Bor Listrik',
            'merkbarang'        => 'Ryu',
            'stokbarang'        => '5',
            'deskripsibarang'  => 'Bor listrik hemat daya',
            'foto'              => '1717382320_bor listrik.jpg',
        ]);

        Barang::create([
            'namabarang'        => 'Grinda Listrik',
            'merkbarang'        => 'Ryu',
            'stokbarang'        => '5',
            'deskripsibarang'  => 'Grinda listrik hemat daya',
            'foto'              => '1717382367_grinda listrik.jpg',
        ]);

        Barang::create([
            'namabarang'        => 'Obeng',
            'merkbarang'        => 'Krisbow',
            'stokbarang'        => '5',
            'deskripsibarang'  => 'Obeng biasa',
            'foto'              => '1717382400_obeng.jpg',
        ]);

        Barang::create([
            'namabarang'        => 'Palu',
            'merkbarang'        => 'Krisbow',
            'stokbarang'        => '5',
            'deskripsibarang'  => 'Palu biasa',
            'foto'              => '1717382474_palu.jpg',
        ]);
    }
}
