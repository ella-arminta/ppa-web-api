<?php

namespace Database\Seeders;

use App\Models\Laporans;
use App\Models\PenangananAwal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PenangananAwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $laporan = Laporans::where('nama_klien','Haha ')->first();
        PenangananAwal::create([
            'laporan_id' => $laporan->id,
            'tanggal_penanganan_awal' => '2021-01-02 01:40:30',
            'hasil' => 'Hasil',
        ]);
    }
}
