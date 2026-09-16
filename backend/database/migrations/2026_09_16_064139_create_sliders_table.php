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
        Schema::create('sliders', function (Blueprint $table) {
    $table->id();
    $table->string('gambar');
    $table->string('judul');
    $table->text('deskripsi');
    $table->string('teks_tombol_utama')->nullable();
    $table->string('link_tombol_utama')->nullable();
    $table->string('teks_tombol_kedua')->nullable();
    $table->string('link_tombol_kedua')->nullable();
    $table->integer('urutan')->default(0);
    $table->boolean('aktif')->default(true);
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sliders');
    }
};
