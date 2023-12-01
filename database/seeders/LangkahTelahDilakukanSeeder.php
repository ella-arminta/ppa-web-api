<?php

namespace Database\Seeders;

use App\Models\LangkahTelahDilakukan;
use App\Models\Laporans;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LangkahTelahDilakukanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $laporan = Laporans::first();
        LangkahTelahDilakukan::create([
            'laporan_id' => $laporan->id,
            'tanggal_pelayanan' => '2023-06-03',
            'pelayanan_yang_diberikan' => 'Pelayanan Kesejahteraan',
            'deskripsi' => 'dibawa ke psikolog mau',
        ]);
    }
}
