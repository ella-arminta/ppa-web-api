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
            $table->string('hubungan')->nullable();
            $table->string('nama_lengkap')->nullable();
            $table->string('nik')->nullable();
            $table->string('no_kk')->nullable();
            $table->string('no_wa')->nullable();
            $table->string('alamat_kk')->nullable();
            $table->string('alamat_domisili')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('sifat_pekerjaan')->nullable();
            $table->integer('penghasilan')->nullable();
            $table->string('agama')->nullable();
            $table->foreignIdFor('App\Models\Kota', 'kota_lahir_id')
                ->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('bpjs');
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