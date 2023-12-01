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

        $laporan2 = Laporans::where('status_id',2)->first();
        $laporan = Laporans::first();

        DetailKasus::create([
            'laporan_id' => $laporan2->id,
            'kategori_kasus_id' => 1,
            'jenis_kasus_id' => 1,
            'lokasi_kasus' => 'hai',
            'deskripsi' => 'jadi ya begitu',
            'tanggal_jam_kejadian' => '2023-10-10 10:10:10'
        ]);
        DetailKasus::create([
            'laporan_id' => $laporan->id,
            'kategori_kasus_id' => 1,
            'jenis_kasus_id' => 1,
            'lokasi_kasus' => 'hai',
            'deskripsi' => 'dianya kasih harapan tapi kabur',
            'tanggal_jam_kejadian' => '2023-10-10 10:10:10'
        ]);
    }
}
