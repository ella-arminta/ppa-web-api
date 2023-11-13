<?php

namespace Database\Seeders;

use App\Models\DetailKasus;
use App\Models\Laporans;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DetailKasusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $laporan = Laporans::where('status_id',2)->first();
        DetailKasus::create([
            'laporan_id' => $laporan->id,
            'kategori_kasus_id' => 1,
            'jenis_kasus_id' => 1,
            'lokasi_kasus' => 'hai',
            'tanggal_jam_kejadian' => '2023-10-10 10:10:10'
        ]);
    }
}
