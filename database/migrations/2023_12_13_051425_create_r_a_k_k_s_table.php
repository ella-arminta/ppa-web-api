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
        Schema::create('r_a_k_k_s', function (Blueprint $table) {
            $table->id('id');
            $table->foreignUuid('laporan_id')
                ->references('id')
                ->on('laporans');
            $table->string('kebutuhan')->nullable();
            $table->string('deskripsi')->nullable();
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