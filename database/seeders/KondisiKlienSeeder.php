<?php

namespace Database\Seeders;

use App\Models\KondisiKlien;
use App\Models\Laporans;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KondisiKlienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $laporan = Laporans::where('status_id',2)->first();
        $satgas = User::first();
        KondisiKlien::create([
            'laporan_id' => $laporan->id,
            'fisik' => 'fisik',
            'psikologis' => 'psikologis',
            'sosial' => 'sosial',
            'spiritual' => 'spiritual',
            'satgas_id' => $satgas->id,
        ]);
        
    }
}
