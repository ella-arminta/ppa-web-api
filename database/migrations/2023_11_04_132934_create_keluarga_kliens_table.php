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
        Schema::create('keluarga_kliens', function (Blueprint $table) {
            $table->id('id');
            $table->foreignUuid('laporan_id')
                ->references('id')
                ->on('laporans');
            $table->foreignIdFor('App\Models\HubunganKeluargaKlien', 'hubungan_id')->nullable();
            $table->string('nama_lengkap');
            $table->string('no_telp')->nullable();
            $table->foreignUuid('satgas_id')
            ->nullable()
            ->default(null)
            ->references('id')
            ->on('users');
            $table->string('nik')->nullable();
            $table->string('alamat_kk')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('alamat_domisili')->nullable();
            $table->timestamps();
            $table->softDeletes();
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