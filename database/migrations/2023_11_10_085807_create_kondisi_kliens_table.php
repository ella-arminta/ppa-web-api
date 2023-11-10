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
        Schema::create('kondisi_kliens', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('laporan_id');
            $table->string('fisik')->nullable();
            $table->string('psikologis')->nullable();
            $table->string('sosial')->nullable();
            $table->string('spiritual')->nullable();
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