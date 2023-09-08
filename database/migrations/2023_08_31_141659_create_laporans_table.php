<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('laporans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('judul');
            $table->string('no_telp_pelapor');
            $table->string('nama_korban');
            $table->string('nama_pelapor');
            $table->tinyInteger('usia');
            $table->foreignIdFor('App\Models\Kategori', 'kategori_id');
            $table->foreignIdFor('App\Models\Alamats', 'alamat_id');
            $table->char('jenis_kelamin', 1);
            $table->foreignIdFor('App\Models\User', 'satgas_pelapor_id');
            $table->foreignIdFor('App\Models\User', 'previous_satgas_id');
            $table->foreignIdFor('App\Models\Statuses', 'status_id');
            $table->string('token', 8);
            $table->foreignIdFor('App\Models\Pendidikans', 'pendidikan_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
