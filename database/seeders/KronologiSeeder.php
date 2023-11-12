<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kronologis;
use App\Models\Laporans;

class KronologiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $laporan = Laporans::where('status_id',2)->first();
        Kronologis::create([
            'laporan_id' => $laporan->id,
            'admin_id' => 1, 
            'isi' => 'This is the kronologis content.',
            'tanggal' => '2021-03-02', // Replace with the actual date
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null, // Assuming it's not deleted
        ]);
        Kronologis::create([
            'laporan_id' => 1,
            'admin_id' => 1, 
            'isi' => 'sfasdf This is the kronologis content.',
            'tanggal' => '2021-04-02', // Replace with the actual date
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null, // Assuming it's not deleted
        ]);
        // Kronologis::factory()->count(3)->create();
    }
}
