<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\DetailKasus;
use App\Models\DetailKlien\Bpjs;
use App\Models\DetailKlien\KategoriKasus;
use App\Models\DetailKlien\Pekerjaan;
use App\Models\LangkahTelahDilakukan;
use App\Models\Pelaku;
use App\Models\PenangananAwal;
use Illuminate\Database\Seeder;

use Illuminate\Support\Str;

use App\Models\Roles;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory()->create([
        //     'name' => 'Glenn Steven',
        //     'email' => 'glenn@test.com',
        //     'password' => bcrypt('password'),
        // ]);
        // $this->run();
        $this->call([
            UserSeeder::class,
            KelurahanSeeder::class,
            KecamatanSeeder::class,
            PendidikanSeeder::class,
            StatusSeeder::class,
            RolesSeeder::class,
            KategoriSeeder::class,
            KotaSeeder::class,
            LaporanSeeder::class,
            SumberPengaduan::class,
            HubunganKeluargaKlienSeeder::class, // hrs ada laporanSeeder
            PekerjaanSeeder::class,
            StatusPerkawinanSeeder::class,
            BpjsSeeder::class,
            DetailKlienSeeder::class, // hrs ada laporanSeeder
            KeluargaKlienSeeder::class, // hrs ada laporanSeeder
            KondisiKlienSeeder::class, // hrs ada laporanSeeder
            AgamaSeeder::class,
            PelakuSeeder::class, // hrs ada laporanSeeder
            PenjadwalanSeeder::class, // hrs ada laporanSeeder
            KategoriKasusSeeder::class,
            JenisKasusSeeder::class,
            DetailKasusSeeder::class, // hrs ada laporanSeeder
            LangkahTelahDilakukanSeeder::class, // hrs ada laporanSeeder
            RAKKSeeder::class, // hrs ada laporanSeeder
            RRKKSeeder::class, // hrs ada laporanSeeder
            PenangananAwalSeeder::class, // hrs ada laporanSeeder
            LintasOPDSeeder::class, // hrs ada laporanSeeder
            // KronologiSeeder::class,
            // AlamatSeeder::class,
            // ProgressReportSeeder::class,
        ]);
        // Roles::factory(3)->create();
        // User::factory(4)->create();
    }
}
