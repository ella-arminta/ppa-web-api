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
            'nama' => 'Personal Problem'
        ]);
    }
}
