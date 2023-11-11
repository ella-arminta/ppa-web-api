<?php

namespace Database\Seeders;

use App\Models\Laporans;
use App\Models\Penjadwalan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PenjadwalanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $laporan = Laporans::first();
        Penjadwalan::create([
            'tanggal_jam' => '2023-08-03 07:13:10',
            'tempat' => 'Kafe',
            'alamat' => 'Kuala lumpur',
            'laporan_id' =>  $laporan->id,
        ]);
    }
}
