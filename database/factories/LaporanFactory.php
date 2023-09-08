<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Laporans>
 */
class LaporanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'id' => 'test',
            'judul' => 'test',
            'no_telp_pelapor' => 'test',
            'nama_korban' => 'test',
            'nama_pelapor' => 'test',
            'kategori_id' => 'test',
            'alamat_id' => 'test',
            'jenis_kelamin' => 'test',
            'satgas_pelapor_id' => 'test',
            'previous_satgas_id' => 'test',
            'status_id' => 'test',
            'token' => 'test',
            'pendidikan_id' => 'test',
        ];
    }
}
