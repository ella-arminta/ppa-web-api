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
            'nama' => 'Intra Personal'
        ]);
    }
}
