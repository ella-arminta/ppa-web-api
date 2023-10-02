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
        Schema::create('kronologis', function (Blueprint $table) {
            $table->id('id');
            $table->foreignUuid('laporan_id');
            $table->foreignUuid('admin_id');
            $table->longText('isi');
            $table->timestamps();
            $table->date('tanggal');
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