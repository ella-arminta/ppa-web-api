<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Laporans;
use App\Models\User;


class LaporanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $satgasPelaporUser1 = User::where('username', 'testing')->first();

        Laporans::create([
            'judul' => 'Laporan KDRT',
            'no_telp_pelapor' => '1234567890',
            'nama_korban' => 'John Doe',
            'nama_pelapor' => 'Jane Smith',
            'validated' => false, 
            'usia' => 30,
            'kategori_id' => 1, 
            'alamat_id' => 1, 
            'jenis_kelamin' => 'L', 
            'satgas_pelapor_id' => $satgasPelaporUser1->id, 
            'previous_satgas_id' => $satgasPelaporUser1->id, 
            'status_id' => 1,
            'token' => 'abc123',
            'pendidikan_id' => 1, 
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
        ]);
        Laporans::create([
            'judul' => 'Laporan Pelecehan',
            'no_telp_pelapor' => '1234567890',
            'nama_korban' => 'Haha ',
            'nama_pelapor' => 'Hihi',
            'validated' => false, 
            'usia' => 20,
            'kategori_id' => 1, 
            'alamat_id' => 1, 
            'jenis_kelamin' => 'P', 
            'satgas_pelapor_id' => $satgasPelaporUser1->id, 
            'previous_satgas_id' => $satgasPelaporUser1->id, 
            'status_id' => 2,
            'token' => 'abc123',
            'pendidikan_id' => 1, 
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
        ]);
        Laporans::create([
            'judul' => 'Laporan Kesuksesan',
            'no_telp_pelapor' => '1234567890',
            'nama_korban' => 'Nyahaha ',
            'nama_pelapor' => 'Nyammy',
            'validated' => false, 
            'usia' => 15,
            'kategori_id' => 1, 
            'alamat_id' => 2, 
            'jenis_kelamin' => 'p', 
            'satgas_pelapor_id' => $satgasPelaporUser1->id, 
            'previous_satgas_id' => $satgasPelaporUser1->id, 
            'status_id' => 3,
            'token' => 'abc123',
            'pendidikan_id' => 2, 
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
        ]);
        
    }
}
