<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kategoris;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kategoris::create([
            'nama' => 'Permasalahan Sosial',
        ]);
        Kategoris::create([
            'nama' => 'Kekerasan',
        ]);
        // Kategoris::create([
        //     'nama' => 'Kesehatan',
        // ]);
        // Kategoris::create([
        //     'nama' => 'Pendidikan',
        // ]);
        // Kategoris::create([
        //     'nama' => 'Penelantaran',
        // ]);
        // Kategoris::create([
        //     'nama' => 'KDRT',
        // ]);
        // Kategoris::create([
        //     'nama' => 'Tawuran',
        // ]);
        // Kategoris::create([
        //     'nama' => 'Narkoba',
        // ]);
        // Kategoris::create([
        //     'nama' => 'Anak Berkebutuhan Khusus (ABK)',
        // ]);
    }
}
