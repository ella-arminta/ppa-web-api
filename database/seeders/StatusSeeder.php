<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            [
                'nama' => 'Menunggu validation'
            ],
            [
                'nama' => 'Sedang ditangani'
            ],
            // [
            //     'nama' => 'Kasus ditolak'
            // ],
            [
                'nama' => 'Kasus selesai'
            ],
            [
                'nama' => 'Kasus dikembalikan'
            ],
            [
                'nama' => 'Kasus diteruskan ke DP3A'
            ],
            // [
            //     'nama' => 'Kasus sudah pernah tercatat'
            // ],
            // Tambahkan data kecamatan lainnya di sini sesuai dengan data yang Anda miliki
        ];

        DB::table('statuses')->insert($statuses);
    }
}
