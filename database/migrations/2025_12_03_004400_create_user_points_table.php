<?php

// database/migrations/xxxx_create_user_points_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_points', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('points');
            $table->enum('type', ['earned', 'redeemed']);
            $table->string('description')->nullable();
            $table->string('reference_type')->nullable(); // Event, Registration, etc
            $table->unsignedBigInteger('reference_id')->nullable();
            $table->timestamps();

            // Indexes
            $table->index(['user_id', 'type']);
            $table->index(['reference_type', 'reference_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_points');
    }
};