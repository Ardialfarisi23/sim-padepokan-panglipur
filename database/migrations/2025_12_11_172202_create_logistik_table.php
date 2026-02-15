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
    Schema::create('logistik', function (Blueprint $table) {
        $table->id();
        $table->string('nama_barang', 255);
        $table->integer('jumlah');
        $table->enum('kondisi', ['baik', 'rusak', 'hilang']);
        $table->date('tanggal_masuk');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logistik');
    }
};
