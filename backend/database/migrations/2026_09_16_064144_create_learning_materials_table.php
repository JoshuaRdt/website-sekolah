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
    Schema::create('learning_materials', function (Blueprint $table) {
    $table->id();
    $table->foreignId('competency_id')->constrained('competencies')->onDelete('cascade');
    $table->string('judul_materi');
    $table->string('file_url');
    $table->string('tipe_file');
    $table->integer('ukuran_file');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('learning_materials');
    }
};
