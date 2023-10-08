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
        Schema::create('progress_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('laporan_id');
            $table->foreignUuid('admin_id');
            $table->longText('isi');
            $table->boolean('is_menyerah')->default(false);
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