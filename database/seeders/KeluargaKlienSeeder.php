<?php

namespace Database\Seeders;

use App\Models\HubunganKeluargaKlien;
use App\Models\KeluargaKlien;
use App\Models\Laporans;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KeluargaKlienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $laporan = Laporans::where('status_id',2)->first();
        $hubungan = HubunganKeluargaKlien::first();
        $satgas = User::first();
        KeluargaKlien::create(
            [
                'laporan_id' => $laporan->id,
                'hubungan_id' => $hubungan->id,
                'nama_lengkap' => 'Sidi Praptama',
                'no_telp' => '08123456789',
                'satgas_id' => $satgas->id,
            ]
        );
    }
}
