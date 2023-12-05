<?php

namespace Database\Seeders;

use App\Models\Laporans;
use App\Models\RRKK;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RRKKSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $laporan = Laporans::where('nama_klien','Haha ')->first();
        RRKK::create([
            'laporan_id' => $laporan->id,
            'ekonomi' => 'Ekonomi',
            'pendidikan' => 'Pendidikan',
            'sosial' => 'Sosial',
            'kesehatan' => 'Kesehatan',
            'hukum' => 'Hukum',
        ]);
    }
}
