<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::create('kelurahans', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->unique();
            $table->foreignIdFor('App\Models\Kecamatans', 'kecamatan_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // DB::statement('ALTER TABLE kelurahans MODIFY created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};