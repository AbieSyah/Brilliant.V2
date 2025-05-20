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
        Schema::create('booking_calendar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kamar_id')
                  ->constrained('kamar')
                  ->cascadeOnDelete();
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('quantity')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_calendar');
    }
};
