<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kamar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('camp_id')
                ->constrained('camp')
                ->cascadeOnDelete();
            $table->string('nama_kamar')->nullable();
            $table->string('type_kamar');
            $table->string('kategori');
            $table->enum('gender', ['Laki-laki', 'Perempuan']);
            $table->integer('jumlah_kasur')->default(1);
            $table->text('fasilitas')->nullable();
            $table->text('peraturan')->nullable();
            $table->string('gambar')->nullable();
            $table->decimal('harga', 15, 2)->default(0);
            $table->text('catatan_tambahan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kamar');
    }
};
