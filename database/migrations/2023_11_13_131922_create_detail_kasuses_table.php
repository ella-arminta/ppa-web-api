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
        Schema::create('detail_kasuses', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('laporan_id')
                ->references('id')
                ->on('laporans');
            $table->foreignIdFor('App\Models\DetailKlien\KategoriKasus', 'kategori_kasus_id');
            $table->foreignIdFor('App\Models\DetailKlien\JenisKasus', 'jenis_kasus_id');
            $table->string('lokasi_kasus');
            $table->dateTime('tanggal_jam_kejadian');
            $table->longText('deskripsi')->nullable();
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