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
    Schema::create('pembelian_seragam', function (Blueprint $table) {
        $table->id();
        $table->foreignId('id_anggota')->constrained('anggota')->cascadeOnDelete();
        $table->string('jenis_seragam', 100);
        $table->string('ukuran', 10);
        $table->date('tanggal_pembelian');
        $table->enum('status', ['pending', 'dibayar', 'diambil'])->default('pending');
        $table->integer('total_harga');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembelian_seragam');
    }
};
