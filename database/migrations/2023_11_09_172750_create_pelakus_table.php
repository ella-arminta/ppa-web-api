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
            ->references('id')
            ->on('users')
            ->nullable()
            ->default(null);
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