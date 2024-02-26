<?php

namespace Database\Seeders;

use App\Models\Laporans;
use App\Models\LintasOPD;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LintasOPDSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $laporan = Laporans::where('nama_klien','Haha ')->first();
        LintasOPD::create([
            'laporan_id' => $laporan->id,
            'tanggal_pelayanan' => '2021-01-01',
            'instansi' => 'Instansi',
            'pelayanan_diberikan' => 'Pelayanan Diberikan',
            'deskripsi_pelayanan' => 'Deskripsi Pelyanan',
        ]);

        LintasOPD::create([
            'laporan_id' => $laporan->id,
            'tanggal_pelayanan' => '2021-02-01',
            'instansi' => 'Instansi 2',
            'pelayanan_diberikan' => 'Pelayanan Diberikan 2',
            'deskripsi_pelayanan' => 'Deskripsi Pelyanan 2',
        ]);
    }
}
