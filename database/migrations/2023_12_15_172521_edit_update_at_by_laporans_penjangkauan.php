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
            $table->dateTime('updated_at_harapan')->nullable();
            $table->foreignUuid('updated_by_harapan')
            ->nullable()
                ->references('id')
                ->on('users');
            
            $table->dateTime('updated_at_dokumen_pendukung')->nullable();
            $table->foreignUuid('updated_by_dokumen_pendukung')
            ->nullable()
                ->references('id')
                ->on('users');
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
