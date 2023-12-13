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
        $laporan = Laporans::where('status_id',2)->first();
        $laporan2 = Laporans::where('status_id',3)->first();
        $satgas = User::first();
        Pelaku::create([
            'laporan_id' => $laporan->id,
            'nama_lengkap' => 'Novemelia Wijaya',
            'hubungan' => 'Kakak tiri',
            'usia' => 17,
            'satgas_id' => $satgas->id,
            'nik' => '1234567890123456',
            'no_kk' => '1234567890123456',
            'kota_lahir_id' => 1,
            'tanggal_lahir' => '2004-11-09',
            'jenis_kelamin' => 'P',
            'agama_id' => 1,
            'pendidikan_id' => 1,
            'pekerjaan' => 'Pelajar',
            'status_perkawinan_id' => 1,
            'alamat_kk' => 'Jl. Raya Bogor',
            'alamat_domisili' => 'Jl. Raya Bogor',
            'kewarganegaraan'  => 'WNI',
            'no_telp' => '081234567890',
            'hubungan_dengan_klien' => 'Kakak tiri'
        ]);
        Pelaku::create([
            'laporan_id' => $laporan2->id,
            'nama_lengkap' => 'Sidi Wijaya',
            'hubungan' => 'Ayah tiri',
            'usia' => 17,
            'satgas_id' => $satgas->id,
            'nik' => '1234567890123456',
            'no_kk' => '1234567890123456',
            'kota_lahir_id' => null,
            'tanggal_lahir' => '2004-11-09',
            'jenis_kelamin' => 'P',
            'agama_id' => 1,
            'pendidikan_id' => 1,
            'pekerjaan' => 'Pelajar',
            'status_perkawinan_id' => 1,
            'alamat_kk' => 'Jl. Raya Bogor',
            'alamat_domisili' => 'Jl. Raya Bogor',
            'kewarganegaraan'  => 'WNI',
            'no_telp' => '081234567890',
            'hubungan_dengan_klien' => 'Kakak tiri'
        ]);
    }
}
