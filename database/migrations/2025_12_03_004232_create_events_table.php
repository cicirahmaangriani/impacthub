<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('event_type_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->text('objectives')->nullable();
            $table->text('requirements')->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->integer('quota')->default(0);
            $table->integer('registered_count')->default(0);
            $table->string('location')->nullable();
            $table->enum('venue_type', ['online', 'offline', 'hybrid'])->default('offline');
            $table->string('image')->nullable();
            $table->json('gallery')->nullable();
            $table->enum('status', ['draft', 'published', 'ongoing', 'completed', 'cancelled'])->default('draft');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->dateTime('registration_deadline');
            $table->text('instructor_info')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('certificate_available')->default(false);
            $table->integer('points_reward')->default(0);
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['status', 'start_date']);
            $table->index('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
