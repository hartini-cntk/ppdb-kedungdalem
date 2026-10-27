<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengaturan_ppdb', function (Blueprint $table) {
            $table->dateTime('tanggal_buka')->nullable();
            $table->dateTime('tanggal_tutup')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('pengaturan_ppdb', function (Blueprint $table) {
            $table->dropColumn([
                'tanggal_buka',
                'tanggal_tutup',
            ]);
        });
    }
};