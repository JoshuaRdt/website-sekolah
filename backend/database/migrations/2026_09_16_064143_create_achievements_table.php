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
    Schema::create('achievements', function (Blueprint $table) {
    $table->id();
    $table->string('judul_prestasi');
    $table->string('tingkat'); // Nasional/Provinsi/Kabupaten
    $table->string('nama_siswa');
    $table->text('keterangan')->nullable();
    $table->string('gambar_url');
    $table->year('tahun');
    $table->boolean('divalidasi_admin')->default(false);
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('achievements');
    }
};
