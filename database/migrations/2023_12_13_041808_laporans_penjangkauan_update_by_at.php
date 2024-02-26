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
        Schema::table('laporans', function (Blueprint $table) {
            $table->dateTime('updated_at_keluarga')->nullable();
            $table->foreignUuid('updated_by_keluarga')
            ->nullable()
                ->references('id')
                ->on('users');
            
            $table->dateTime('updated_at_detail_klien')->nullable();
            $table->foreignUuid('updated_by_detail_klien')
            ->nullable()
                ->references('id')
                ->on('users');
            
            $table->dateTime('updated_at_pelaku')->nullable();
            $table->foreignUuid('updated_by_pelaku')
            ->nullable()
                ->references('id')
                ->on('users');
            
            $table->dateTime('updated_at_situasi_keluarga')->nullable();
            $table->foreignUuid('updated_by_situasi_keluarga')
            ->nullable()
                ->references('id')
                ->on('users');

            $table->dateTime('updated_at_kronologi')->nullable();
            $table->foreignUuid('updated_by_kronologi')
            ->nullable()
                ->references('id')
                ->on('users');
            
            $table->dateTime('updated_at_kondisi_klien')->nullable();
            $table->foreignUuid('updated_by_kondisi_klien')
            ->nullable()
                ->references('id')
                ->on('users');
            
            $table->dateTime('updated_at_langkah_telah_dilakukan')->nullable();
            $table->foreignUuid('updated_by_langkah_telah_dilakukan')
            ->nullable()
                ->references('id')
                ->on('users');
            
            $table->dateTime('updated_at_rakk')->nullable();
            $table->foreignUuid('updated_by_rakk')
            ->nullable()
                ->references('id')
                ->on('users');
            
            $table->dateTime('updated_at_rrkk')->nullable();
            $table->foreignUuid('updated_by_rrkk')
            ->nullable()
                ->references('id')
                ->on('users');
            
            $table->dateTime('updated_at_lintas_opd')->nullable();
            $table->foreignUuid('updated_by_lintas_opd')
            ->nullable()
                ->references('id')
                ->on('users');
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
