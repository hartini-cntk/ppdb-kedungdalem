<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengaturan_ppdb', function (Blueprint $table) {
            $table->date('tanggal_daftar_ulang')->nullable();
            $table->string('jam_daftar_ulang')->nullable();
            $table->string('lokasi_daftar_ulang')->nullable();
            $table->text('persyaratan_daftar_ulang')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('pengaturan_ppdb', function (Blueprint $table) {
            $table->dropColumn([
                'tanggal_daftar_ulang',
                'jam_daftar_ulang',
                'lokasi_daftar_ulang',
                'persyaratan_daftar_ulang',
            ]);
        });
    }
};
