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
            $table->boolean('validated')->default(false);
            $table->tinyInteger('usia');
            $table->foreignIdFor('App\Models\Kategoris', 'kategori_id');
            $table->foreignIdFor('App\Models\Alamats', 'alamat_id');
            $table->char('jenis_kelamin', 1);
            $table->foreignUuid('satgas_pelapor_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade')
            ->nullable();
            $table->foreignUuid('previous_satgas_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade')
            ->nullable();
            $table->foreignIdFor('App\Models\Statuses', 'status_id')->default(1);
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
