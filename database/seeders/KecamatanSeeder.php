<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kecamatans = [
            [
                'nama' => 'Kecamatan Simokerto'
            ],
            // [
            //     'nama' => 'Kecamatan 2'
            // ],
            // Tambahkan data kecamatan lainnya di sini sesuai dengan data yang Anda miliki
        ];

        DB::table('kecamatans')->insert($kecamatans);
    }
}
