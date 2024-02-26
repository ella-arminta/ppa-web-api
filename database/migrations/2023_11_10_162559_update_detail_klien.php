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
        Schema::table('detail_kliens', function (Blueprint $table) {
            $table->foreignId('pekerjaan_id')->constrained('pekerjaans')->nullable();
            $table->foreignId('status_perkawinan_id')->constrained('status_perkawinans')->nullable();
            $table->foreignId('bpjs_id')->constrained('bpjs')->nullable();

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
