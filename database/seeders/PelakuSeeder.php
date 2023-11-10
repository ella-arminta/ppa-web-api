<?php

namespace Database\Seeders;

use App\Models\Laporans;
use App\Models\Pelaku;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PelakuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $laporan = Laporans::first();
        $satgas = User::first();
        Pelaku::create([
            'laporan_id' => $laporan->id,
            'nama_lengkap' => 'Novemelia Wijaya',
            'hubungan' => 'Kakak tiri',
            'usia' => 17,
            'satgas_id' => $satgas->id,
        ]);
    }
}
