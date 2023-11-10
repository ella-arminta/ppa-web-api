<?php

namespace Database\Seeders;

use App\Models\DetailKlien\Bpjs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BpjsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bpjs::create([
            'nama' => 'PBI'
        ]);
        Bpjs::create([
            'nama' => 'Korporasi'
        ]);
        Bpjs::create([
            'nama' => 'Mandiri'
        ]);
        Bpjs::create([
            'nama' => 'Tidak Punya'
        ]);
    }
}
