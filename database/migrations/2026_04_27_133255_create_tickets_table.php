<?php

use App\TicketStatus;
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
        Schema::create('tickets', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unique(['play_id', 'seat_id']);
            $table->foreignUuid('play_id')->constrained('plays')->onDelete('cascade');
            $table->foreignId('seat_id')->constrained('seats')->onDelete('cascade');
            $table->foreignUuId('user_id')->constrained('users')->onDelete('cascade');
            $table->integer('price_paid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
