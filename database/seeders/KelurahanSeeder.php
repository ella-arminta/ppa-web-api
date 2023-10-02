<?php

namespace Database\Seeders;

use App\Models\Kelurahans;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class KelurahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kelurahans::create([
            'nama' => 'Kelurahan 1', 
            'kecamatan_id' => 1
        ]);
        Kelurahans::create([
            'nama' => 'Kelurahan 2', 
            'kecamatan_id' => 1
        ]);
        Kelurahans::create([
            'nama' => 'Kelurahan 3', 
            'kecamatan_id' => 2
        ]);

    }
}
