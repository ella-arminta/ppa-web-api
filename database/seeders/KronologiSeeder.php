<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kronologis;
use App\Models\Laporans;
use App\Models\User;


class KronologiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $satgasPelaporUser1 = User::where('username', 'testing')->first();
        $laporan = Laporans::where('satgas_pelapor_id', $satgasPelaporUser1->id)->first();
        
        Kronologis::create([
            'laporan_id' => $laporan->id,
            'admin_id' => $satgasPelaporUser1->id, 
            'isi' => 'This is the kronologis content.',
            'tanggal' => '2021-03-02', // Replace with the actual date
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null, // Assuming it's not deleted
        ]);
        Kronologis::create([
            'laporan_id' =>  $laporan->id,
            'admin_id' => $satgasPelaporUser1->id, 
            'isi' => 'sfasdf This is the kronologis content.',
            'tanggal' => '2021-04-02', // Replace with the actual date
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null, // Assuming it's not deleted
        ]);
        // Kronologis::factory()->count(3)->create();
    }
}
