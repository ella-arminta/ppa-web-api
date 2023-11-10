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
        Schema::create('keluarga_kliens', function (Blueprint $table) {
            $table->id('id');
            $table->foreignUuid('laporan_id')
                ->references('id')
                ->on('laporans');
            $table->foreignIdFor('App\Models\HubunganKeluargaKlien', 'hubungan_id')->nullable();
            $table->string('nama_lengkap');
            $table->string('no_telp');
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