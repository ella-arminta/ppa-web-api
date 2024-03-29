<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SumberPengaduan extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            [
                'nama' => 'Warga'
            ],
            [
                'nama' => 'Kelurahan'
            ],
            // Tambahkan data kecamatan lainnya di sini sesuai dengan data yang Anda miliki
        ];

        DB::table('sumber_pengaduans')->insert($statuses);
    }
}
