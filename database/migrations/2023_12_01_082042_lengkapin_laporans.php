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
        Schema::table('laporans', function (Blueprint $table) {
            $table->string('nomor_register')->nullable();
            $table->timestamp('tanggal_penjangkauan')->nullable();
            $table->foreignId('kota_id_pelapor')
                ->nullable()
                ->default(null)
                ->references('id')
                ->on('kotas');
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
