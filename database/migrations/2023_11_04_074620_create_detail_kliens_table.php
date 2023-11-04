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
        Schema::create('detail_kliens', function (Blueprint $table) {
            $table->id('id');
            $table->foreignUuid('laporan_id')
                ->references('id')
                ->on('laporans');
            $table->boolean('warga_surabaya')->nullable();
            $table->foreignIdFor('App\Models\Kota', 'kota_id')
                ->default(1)
                ->nullable();
            $table->foreignIdFor('App\Models\Kecamatans', 'kecamatan_id')
            ->nullable();
            $table->string('no_kk')->nullable();
            $table->string('no_wa')->nullable();
            $table->boolean('is_done')->default(false);
            $table->string('alamat_kk')->nullable();
            $table->foreignIdFor('App\Models\Kecamatans', 'kecamatan_kk_id')
                ->nullable();
            $table->foreignIdFor('App\Models\Kelurahans', 'kelurahan_kk_id')
                ->nullable();
            $table->foreignIdFor('App\Models\Kota', 'kota_lahir_id')
                ->nullable();
            $table->date('tanggal_lahir')
                ->nullable();
            $table->string('agama')->nullable();
            $table->string('kategori_klien')->nullable();
            $table->string('jenis_klien')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->integer('penghasilan_bulanan')->nullable();
            $table->string('status_perkawinan')->nullable();
            $table->string('bpjs')->nullable();
            $table->string('pendidikan_kelas')->nullable();
            $table->string('pendidikan_instansi')->nullable();
            $table->string('pendidikan_jurusan')->nullable();
            $table->string('pendidikan_thn_lulus')->nullable();
            $table->boolean('is_done_keluarga')->default(false);
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