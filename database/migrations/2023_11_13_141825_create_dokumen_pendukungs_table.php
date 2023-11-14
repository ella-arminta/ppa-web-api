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
        Schema::create('dokumen_pendukungs', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('laporan_id')
                ->references('id')
                ->on('laporans');
            $table->longText('foto_klien')->nullable();
            $table->longText('foto_tempat_tinggal')->nullable();
            $table->longText('foto_pendampingan_awal')->nullable();
            $table->longText('foto_pendampingan_lanjutan')->nullable();
            $table->longText('foto_pendampingan_monitoring')->nullable();
            $table->longText('foto_kk')->nullable();
            $table->longText('dokumen_pendukung')->nullable();
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