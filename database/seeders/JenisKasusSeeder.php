<?php

namespace Database\Seeders;

use App\Models\DetailKlien\JenisKasus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisKasusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JenisKasus::create([
            'nama' => 'Pengobatan',
            'kategori_kasus_id' => 3
        ]);
        JenisKasus::create([
            'nama' => 'Pemeriksaan',
            'kategori_kasus_id' => 3
        ]);
        JenisKasus::create([
            'nama' => 'Putus Sekolah',
            'kategori_kasus_id' => 4
        ]);
        JenisKasus::create([
            'nama' => 'Fisik',
            'kategori_kasus_id' => 2
        ]);
        JenisKasus::create([
            'nama' => 'Psikis',
            'kategori_kasus_id' => 2
        ]);
        JenisKasus::create([
            'nama' => 'Fisik',
            'kategori_kasus_id' => 1
        ]);
        JenisKasus::create([
            'nama' => 'Psikis',
            'kategori_kasus_id' => 1
        ]);
        JenisKasus::create([
            'nama' => 'Seks',
            'kategori_kasus_id' => 1
        ]);
    }
}
