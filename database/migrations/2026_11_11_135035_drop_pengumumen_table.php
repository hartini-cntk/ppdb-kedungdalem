
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('pengumumen');
    }

    public function down(): void
    {
        // Membuat kembali tabel jika migration di-rollback.
        Schema::create('pengumumen', function ($table) {
            $table->id();
            $table->string('judul');
            $table->text('isi');
            $table->date('tanggal');
            $table->timestamps();
        });
    }
};
