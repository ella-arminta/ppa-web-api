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
        Schema::table('laporans', function (Blueprint $table) {
            $table->integer('status_keluarga')->default(0);
            $table->integer('status_detail_klien')->default(0);
            $table->integer('status_pelaku')->default(0);
            $table->integer('status_situasi_keluarga')->default(0);
            $table->integer('status_kronologi')->default(0);
            $table->integer('status_harapan_klien_dan_keluarga')->default(0);
            $table->integer('status_kondisi_klien')->default(0);
            $table->integer('status_langkah_telah_dilakukan')->default(0);
            $table->integer('status_dokumen_pendukung')->default(0);
            $table->string('sumber_aduan')->nullable();
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
