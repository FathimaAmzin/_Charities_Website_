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
        Schema::create('admin_notifications', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // 'user_registered', 'course_request', 'service_request', 'volunteer', 'contact'
            $table->string('title');
            $table->text('message');
            $table->string('link')->nullable();
            $table->string('icon')->default('fa-solid fa-bell');
            $table->string('badge_class')->default('bg-primary text-white');
            $table->boolean('is_read')->default(false);
            $table->json('data')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_notifications');
    }
};

