<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            LaporanSeeder::class,
            SumberPengaduan::class,
            // KronologiSeeder::class,
            // AlamatSeeder::class,
            // ProgressReportSeeder::class,
        ]);
        // User::create([
        //     'name' => 'Glenn Steven',
        //     'email' => 'glenn@test.com',
        //     'password' => bcrypt('password'),
        //     'remember_token' => str()->random(10),
        //     'email_verified_at' => now(),
        // ]);
        // Roles::factory(3)->create();
        // User::factory(4)->create();
    }
}
