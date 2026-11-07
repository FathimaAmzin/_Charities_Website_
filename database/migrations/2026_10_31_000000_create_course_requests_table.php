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
        Schema::create('course_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('service_id')->nullable()->constrained('services')->nullOnDelete();
            $table->string('type')->default('course'); // 'course' or 'service'
            $table->string('course_title');
            $table->string('full_name');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('nic')->nullable();
            $table->string('district')->nullable();
            $table->string('city')->nullable();
            $table->string('education_level')->nullable();
            $table->string('preferred_schedule')->nullable();
            $table->text('message')->nullable();
            $table->string('status')->default('pending'); // pending, contacted, approved, completed, rejected
            $table->boolean('is_read')->default(false);
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_requests');
    }
};

