<?php

namespace Database\Seeders;

use App\Models\Transportasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransportasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Transportasi::create([
            'namatransportasi'          => 'Pick Up Hilux',
            'merktransportasi'          => 'Toyota',
            'stoktransportasi'          => '1',
            'deskripsitransportasi'     => 'Pick UP single cabin',
            'foto'                      => 'hilux.jpg',
        ]);

        Transportasi::create([
            'namatransportasi'          => 'Truk Hino 300',
            'merktransportasi'          => 'Hino',
            'stoktransportasi'          => '1',
            'deskripsitransportasi'     => 'Truk dengan kapasitas 8 ton',
            'foto'                      => 'hino 300.jpg',
        ]);

        Transportasi::create([
            'namatransportasi'          => 'Motor Roda 3',
            'merktransportasi'          => 'Viar',
            'stoktransportasi'          => '1',
            'deskripsitransportasi'     => 'Viar motor roda 3',
            'foto'                      => 'viar roda 3.jpg',
        ]);
    }
}
