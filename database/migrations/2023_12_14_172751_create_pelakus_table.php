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
        //
        Schema::create('pelakus', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('laporan_id');
            $table->string('nama_lengkap');
            $table->string('hubungan')->nullable();
            $table->string('usia')->nullable();
            $table->foreignUuid('satgas_id')
            ->nullable()
            ->default(null)
            ->references('id')
            ->on('users');
            $table->timestamps();
            $table->softDeletes();
            $table->string('nik')->nullable();
            $table->string('no_kk')->nullable();
            $table->foreignId('kota_lahir_id')
            ->nullable()
            ->default(null)
            ->references('id')
            ->on('kotas');
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
            $table->foreignId('agama_id')
            ->nullable()
            ->default(null)
            ->references('id')
            ->on('agamas');
            $table->foreignId('pendidikan_id')
            ->nullable()
            ->default(null)
            ->references('id')
            ->on('pendidikans');
            $table->string('pekerjaan')->nullable();
            $table->foreignId('status_perkawinan_id')
            ->nullable()
            ->default(null)
            ->references('id')
            ->on('status_perkawinans');
            $table->string('alamat_kk')->nullable();
            $table->string('alamat_domisili')->nullable();
            $table->string('kewarganegaraan')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('hubungan_dengan_klien')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};