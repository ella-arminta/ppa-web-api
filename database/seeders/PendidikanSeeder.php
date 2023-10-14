<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pendidikans;


class PendidikanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pendidikans::create([
            'nama' => 'SD',
        ]);
        Pendidikans::create([
            'nama' => 'SMP',
        ]);
        Pendidikans::create([
            'nama' => 'SMA',
        ]);
        Pendidikans::create([
            'nama' => 'Tidak sekolah',
        ]);
        Pendidikans::create([
            'nama' => 'Lainnya atau tidak tahu',
        ]);
    }
}
