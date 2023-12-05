<?php

namespace Database\Seeders;

use App\Models\Laporans;
use App\Models\RAKK;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RAKKSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $laporan = Laporans::where('nama_klien','Haha ')->first();
        RAKK::create([
            'laporan_id' => $laporan->id,
            'pend_psikologis' => 'Pendampingan Psikologis',
            'pend_medis' => 'Pendampingan Medis',
            'pend_hukum' => 'Pendampingan Hukum',
            'psikososial' => 'Psikososial',
            'rumah_aman' => 'Shelter ABH',
        ]);
    }
}
