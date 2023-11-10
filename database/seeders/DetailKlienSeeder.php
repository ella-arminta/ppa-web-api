<?php

namespace Database\Seeders;

use App\Models\DetailKlien;
use App\Models\Laporans;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DetailKlienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $laporan = Laporans::first();
        $satgas = User::first();
        DetailKlien::create([
            'laporan_id' => $laporan->id,
            'warga_surabaya' => 0,
            'kota_id' => 1,
            'kecamatan_id' => 1,
            'no_kk' => '23412342',
            'no_wa' => '2341',
            'alamat_kk' => 'sdfsdaf',
            'kecamatan_kk_id' => 1,
            'kelurahan_kk_id' => 1,
            'kota_lahir_id' => 1,
            'tanggal_lahir' => '2023-10-10',
            'agama' => 'Kristen',
            'kategori_klien' => 'sdfsd',
            'jenis_klien' => 'sdfa',
            'pekerjaan' => 'sadf',
            'penghasilan_bulanan' => 1000,
            'status_perkawinan' => 'Menikah',
            'bpjs' => 'pbib',
            'pendidikan_kelas' => 'sdf',
            'pendidikan_instansi' => 'sdf',
            'pendidikan_jurusan' => 'sdf',
            'pendidikan_thn_lulus' => 2023,
            'satgas_id' => $satgas['id']
        ]);
    }
}
