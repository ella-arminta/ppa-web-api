<?php

namespace Database\Seeders;

use App\Models\HubunganKeluargaKlien;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HubunganKeluargaKlienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HubunganKeluargaKlien::create([
            'nama' => 'Ayah Kandung'
        ]);
        HubunganKeluargaKlien::create([
            'nama' => 'Ibu Kandung'
        ]);
        HubunganKeluargaKlien::create([
            'nama' => 'Saudara'
        ]);
    }
}
