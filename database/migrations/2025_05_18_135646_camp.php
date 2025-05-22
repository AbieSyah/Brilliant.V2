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
        Schema::create('camp', function (Blueprint $table) {
            $table->id();
            $table->string('nama_camp')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('gambar_camp')->nullable();
            $table->text('alamat')->nullable();
            $table->integer('jumlah_maksimal_kamar')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('camp');
    }
};
