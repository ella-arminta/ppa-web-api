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
            $table->date('tanggal_pengaduan')->nullable();
            $table->time('jam_pengaduan')->nullable();
            $table->string('uraian_singkat_masalah');
            $table->string('no_telp_pelapor');
            $table->string('no_telp_klien');
            $table->string('nama_klien');
            $table->string('nama_pelapor');
            $table->string('inisial_klien')->nullable();
            $table->string('nik_pelapor')->nullable();
            $table->string('nik_klien')->nullable();
            $table->boolean('validated')->default(false);
            $table->tinyInteger('usia');
            $table->string('alamat_pelapor');
            $table->string('alamat_klien');
            $table->string('rw');
            $table->string('rt');
            $table->foreignIdFor('App\Models\Kategoris', 'kategori_id');
            $table->foreignIdFor('App\Models\Kelurahans', 'kelurahan_id')
            ->default(1)
            ->nullable();
            $table->char('jenis_kelamin', 1);
            $table->foreignUuid('satgas_pelapor_id')
                ->references('id')
                ->on('users')
                ->nullable()
                ->default(null);
            $table->foreignUuid('previous_satgas_id')
                ->references('id')
                ->on('users')
                ->nullable()
                ->default(null);
            $table->foreignIdFor('App\Models\Statuses', 'status_id')->default(1);
            $table->string('token', 8);
            $table->foreignIdFor('App\Models\Pendidikans', 'pendidikan_id');
            $table->foreignIdFor('App\Models\SumberPengaduan', 'sumber_pengaduan_id');
            $table->string('dokumentasi_pengaduan')->nullable();
            $table->longText('situasi_keluarga')->nullable();
            $table->longText('kronologi_kejadian')->nullable();
            $table->longText('harapan_klien_dan_keluarga')->nullable();
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
