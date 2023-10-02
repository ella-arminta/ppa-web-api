<?php

namespace Database\Seeders;

use App\Models\Statuses;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use NunoMaduro\Collision\Adapters\Phpunit\State;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Statuses::create([
            'nama' => 'Menunggu validation'
        ]);
        Statuses::create([
            'nama' => 'Sedang ditangani'
        ]);
        Statuses::create([
            'nama' => 'Kasus ditolak'
        ]);
        Statuses::create([
            'nama' => 'Kasus selesai'
        ]);
        Statuses::create([
            'nama' => 'Kasus dikembalikan'
        ]);
        Statuses::create([
            'nama' => 'Kasus diteruskan ke DP3 A'
        ]);
        Statuses::create([
            'nama' => 'Kasus sudah pernah tercatat'
        ]);
    }
}
