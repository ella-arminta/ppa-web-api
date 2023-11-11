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
        Schema::create('penjadwalans', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('laporan_id')
                ->references('id')
                ->on('laporans')
                ->nullable()
                ->default(null);
            $table->dateTime('tanggal_jam');
            $table->string('tempat');
            $table->string('alamat');
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