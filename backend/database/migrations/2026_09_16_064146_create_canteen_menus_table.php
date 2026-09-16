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
    Schema::create('canteen_menus', function (Blueprint $table) {
    $table->id();
    $table->string('nama');
    $table->string('kategori'); // Makanan/Minuman/Snack/Paket Hemat
    $table->text('deskripsi');
    $table->decimal('harga', 10, 2);
    $table->string('gambar')->nullable();
    $table->decimal('rating', 2, 1)->default(0);
    $table->integer('terjual')->default(0);
    $table->boolean('tersedia')->default(true);
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('canteen_menus');
    }
};
