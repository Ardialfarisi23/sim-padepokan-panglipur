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
    Schema::create('hasil_ujian', function (Blueprint $table) {
        $table->id();
        $table->foreignId('id_anggota')->constrained('anggota')->cascadeOnDelete();
        $table->integer('nilai');
        $table->text('keterangan')->nullable();
        $table->date('tanggal_ujian');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_ujian');
    }
};
