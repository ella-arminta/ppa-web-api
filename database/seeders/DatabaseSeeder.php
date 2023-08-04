<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Roles;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Glenn Steven',
            'email' => 'glenn@test.com',
            'password' => bcrypt('password'),
        ]);
        
        // Roles::factory(3)->create();
        // User::factory(4)->create();
    }
}
