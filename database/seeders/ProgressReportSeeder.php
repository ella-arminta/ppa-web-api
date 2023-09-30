<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProgressReports;


class ProgressReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProgressReports::create([
            'laporan_id' => 1,
            'admin_id' => 2, 
            'isi' => 'This is the progress report content.',
            'is_menyerah' => false,
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
        ]);
        ProgressReports::create([
            'laporan_id' => 1,
            'admin_id' => 2, 
            'isi' => '2 This is the progress report content.',
            'is_menyerah' => false,
            'created_at' => '2021-05-01 00:00:00',
            'updated_at' => '2021-05-01 00:00:00',
            'deleted_at' => null,
        ]);
        ProgressReports::create([
            'laporan_id' => 1,
            'admin_id' => 2, 
            'isi' => '3 This is the progress report content.',
            'is_menyerah' => false,
            'created_at' => '2021-03-01 00:00:00',
            'updated_at' => '2021-03-01 00:00:00',
            'deleted_at' => null,
        ]);
    }
}
