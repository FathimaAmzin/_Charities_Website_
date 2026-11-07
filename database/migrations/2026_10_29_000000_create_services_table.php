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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('short_title')->nullable();
            $table->string('category')->default('Humanitarian Aid');
            $table->string('type')->default('service'); // 'service' or 'course'
            $table->string('icon')->default('fa-solid fa-hand-holding-heart');
            $table->string('accent_color')->default('#2563EB');
            $table->string('image')->nullable();
            $table->string('support_image')->nullable();
            $table->string('request_image')->nullable();
            $table->string('provide_image')->nullable();
            $table->text('support_details')->nullable();
            $table->text('request_details')->nullable();
            $table->text('provide_details')->nullable();
            $table->text('summary')->nullable();
            $table->longText('description')->nullable();
            $table->json('highlights')->nullable();
            $table->string('impact')->nullable();
            $table->string('course_duration')->nullable();
            $table->string('course_level')->nullable();
            $table->string('status')->default('active');
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};

