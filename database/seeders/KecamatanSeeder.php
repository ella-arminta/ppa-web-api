<?php

namespace Database\Seeders;

use App\Models\Kecamatans;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kecamatans::create([
            'nama' => 'Kecamatan 1',
        ]);
        Kecamatans::create([
            'nama' => 'Kecamatan 2',
        ]);

    }
}
