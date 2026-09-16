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
    Schema::create('school_profiles', function (Blueprint $table) {
    $table->id();
    $table->string('nama_sekolah')->default('SMKN 1 Ngawen');
    $table->text('visi')->nullable();
    $table->longText('misi')->nullable();
    $table->longText('sejarah')->nullable();
    $table->string('alamat')->nullable();
    $table->string('telepon')->nullable();
    $table->string('email')->nullable();
    $table->string('website')->nullable();
    $table->string('logo_url')->nullable();
    $table->timestamps();
});;
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_profiles');
    }
};
