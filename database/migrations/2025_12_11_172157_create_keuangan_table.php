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
    Schema::create('keuangan', function (Blueprint $table) {
        $table->id();
        $table->foreignId('id_anggota')->nullable()->constrained('anggota')->nullOnDelete();
        $table->enum('jenis_transaksi', ['pemasukan', 'pengeluaran']);
        $table->integer('jumlah');
        $table->text('keterangan')->nullable();
        $table->date('tanggal_transaksi');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keuangan');
    }
};
