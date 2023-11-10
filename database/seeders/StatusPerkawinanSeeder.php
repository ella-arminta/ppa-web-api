<?php

namespace Database\Seeders;

use App\Models\DetailKlien\StatusPerkawinan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusPerkawinanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //in:Belum Menikah,Menikah,Cerai Hidup,Cerai Mati
        StatusPerkawinan::create([
            'nama' => 'Belum Menikah'
        ]);
        StatusPerkawinan::create([
            'nama' => 'Menikah'
        ]);
        StatusPerkawinan::create([
            'nama' => 'Cerai Hidup'
        ]);
        StatusPerkawinan::create([
            'nama' => 'Cerai Mati'
        ]);
    }
}
