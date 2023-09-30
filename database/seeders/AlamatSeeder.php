<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Alamats;


class AlamatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Alamats::create([
            'nama' => 'Siwalankerto Mojokerto Semarang',
            'rt' => '110',
            'rw' => '112',
            'kelurahan_id' => 1,
        ]);
        Alamats::create([
            'nama' => 'Alamat 2',
            'rt' => '113',
            'rw' => '114',
            'kelurahan_id' => 2,
        ]);
        Alamats::create([
            'nama' => 'Alamat 3',
            'rt' => '115',
            'rw' => '116',
            'kelurahan_id' => 3,
        ]);
    }
}
