<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('facilities', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kamar');
            $table->text('deskripsi');
            $table->enum('tipe_kamar', [
                'regular',
                'regular+',
                'vip',
                'vvip',
                'homestay',
                'homestay+',
                'barak'
            ]);
            $table->enum('kategori', ['brilliant', 'bieplus']);
            $table->enum('gender', ['pria', 'wanita']);
            $table->decimal('harga', 10, 2);
            $table->string('image')->nullable(); // Add this line
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('facilities');
    }
};