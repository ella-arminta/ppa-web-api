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
        $laporan = Laporans::where('status_id',2)->first();
        $laporan2 = Laporans::where('status_id',2)->get()[2];
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
            'agama_id' => 2,
            'kategori_klien' => 'anak',
            'jenis_klien' => 'umum',
            'pekerjaan_id' => 1,
            'penghasilan_bulanan' => 1000,
            'status_perkawinan_id' => 3,
            'bpjs_id' => 3,
            'pendidikan_kelas' => 'sdf',
            'pendidikan_instansi' => 'sdf',
            'pendidikan_jurusan' => 'sdf',
            'pendidikan_thn_lulus' => 2023,
            'satgas_id' => $satgas['id']
        ]);

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
            'agama_id' => 2,
            'kategori_klien' => 'anak',
            'jenis_klien' => 'disabilitas',
            'pekerjaan_id' => 1,
            'penghasilan_bulanan' => 1000,
            'status_perkawinan_id' => 3,
            'bpjs_id' => 3,
            'pendidikan_kelas' => 'sdf',
            'pendidikan_instansi' => 'sdf',
            'pendidikan_jurusan' => 'sdf',
            'pendidikan_thn_lulus' => 2023,
            'satgas_id' => $satgas['id']
        ]);
    }
}
