<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('prestasi', function (Blueprint $table) {

            $table->string('slug')->unique()->after('judul');
            $table->text('ringkasan')->nullable()->after('slug');
            $table->string('thumbnail')->nullable()->after('ringkasan');

            $table->enum('status', ['draft', 'publish'])
                  ->default('publish')
                  ->after('tanggal');
        });
    }

    public function down(): void
    {
        Schema::table('prestasi', function (Blueprint $table) {
            $table->dropColumn([
                'slug',
                'ringkasan',
                'thumbnail',
                'status',
            ]);
        });
    }
};

