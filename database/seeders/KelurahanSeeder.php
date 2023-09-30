<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class KelurahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kelurahans = [
            [
                'nama' => 'Kelurahan 1', 
                'kecamatan_id' => 1
            ], // Sesuaikan id kecamatan
            [
                'nama' => 'Kelurahan 2', 
                'kecamatan_id' => 1
            ], // Sesuaikan id kecamatan
            [
                'nama' => 'Kelurahan 3', 
                'kecamatan_id' => 2
            ], // Sesuaikan id kecamatan
            // Tambahkan data kelurahan lainnya di sini sesuai dengan data yang Anda miliki
        ];

        DB::table('kelurahans')->insert($kelurahans);

    }
}
