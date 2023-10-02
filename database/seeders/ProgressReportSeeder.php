<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProgressReports;
use App\Models\Laporans;
use App\Models\User;


class ProgressReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $satgasPelaporUser1 = User::where('username', 'testing')->first();
        $laporan = Laporans::where('satgas_pelapor_id', $satgasPelaporUser1->id)->first();

        ProgressReports::create([
            'laporan_id' => $laporan->id,
            'admin_id' => $satgasPelaporUser1->id, 
            'isi' => 'This is the progress report content.',
            'is_menyerah' => false,
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
        ]);
        ProgressReports::create([
            'laporan_id' => $laporan->id,
            'admin_id' => $satgasPelaporUser1->id, 
            'isi' => '2 This is the progress report content.',
            'is_menyerah' => false,
            'created_at' => '2021-05-01 00:00:00',
            'updated_at' => '2021-05-01 00:00:00',
            'deleted_at' => null,
        ]);
        ProgressReports::create([
            'laporan_id' => $laporan->id,
            'admin_id' => $satgasPelaporUser1->id, 
            'isi' => '3 This is the progress report content.',
            'is_menyerah' => false,
            'created_at' => '2021-03-01 00:00:00',
            'updated_at' => '2021-03-01 00:00:00',
            'deleted_at' => null,
        ]);
    }
}
