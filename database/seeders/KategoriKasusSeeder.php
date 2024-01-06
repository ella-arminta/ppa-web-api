<?php

namespace Database\Seeders;

use App\Models\DetailKlien\KategoriKasus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriKasusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KategoriKasus::create([
            'nama' => 'Non KDRT',
            'kategori_id' => 2
        ]);
        KategoriKasus::create([
            'nama' => 'KDRT',
            'kategori_id' => 2
        ]);

        KategoriKasus::create([
            'nama' => 'Kesehatan',
            'kategori_id' => 1
        ]);

        KategoriKasus::create([
            'nama' => 'Pendidikan',
            'kategori_id' => 1
        ]);
    }
}
