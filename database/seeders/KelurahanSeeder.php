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
                'nama' => 'Tambakrejo', 
                'kecamatan_id' => 1
            ], 
            [
                'nama' => 'Kelurahan 2', 
                'kecamatan_id' => 1
            ], 
        ];

        DB::table('kelurahans')->insert($kelurahans);

    }
}
