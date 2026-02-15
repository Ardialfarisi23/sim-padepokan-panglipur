<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('prestasi', function (Blueprint $table) {
        $table->id();
        $table->foreignId('id_anggota')->constrained('anggota')->cascadeOnDelete();
        $table->string('judul');
        $table->text('isi');
        $table->string('kategori', 100);
        $table->date('tanggal');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestasi');
    }
};
