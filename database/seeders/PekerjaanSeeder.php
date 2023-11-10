<?php

namespace Database\Seeders;

use App\Models\DetailKlien\Pekerjaan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PekerjaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pekerjaan::create([
            'nama' => 'Pekerjaan 1',
        ]);
        Pekerjaan::create([
            'nama' => 'Pekerjaan 2',
        ]);
    }
}
