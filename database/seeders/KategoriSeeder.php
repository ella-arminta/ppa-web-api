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
            'nama' => 'KDRT',
        ]);
        Kategoris::create([
            'nama' => 'Pelecehan',
        ]);
        Kategoris::create([
            'nama' => 'Penganiayaan',
        ]);
    }
}
