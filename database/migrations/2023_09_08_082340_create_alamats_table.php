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
        Schema::create('alamats', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->unique();
            $table->string('rt', 3)->unique();
            $table->string('rw', 3)->unique();
            $table->foreignIdFor('App\Models\Kelurahans', 'kelurahan_id')->nullable();
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