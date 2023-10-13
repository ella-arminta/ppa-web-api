<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::factory()->count(3)->hasLaporans(2)->create();
        User::create([
            'nama' => 'Glenn Ganteng',
            'username' => 'testing',
            'password' => bcrypt('password'),
            'no_telp' => '081234567890',
            'role_id' => 1,
        ]);
        User::create([
            'nama' => 'Super Admin Pak',
            'username' => 'testing2',
            'password' => bcrypt('password'),
            'no_telp' => '081234567891',
            'role_id' => 2,
        ]);
    }
}
