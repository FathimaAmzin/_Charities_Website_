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
        Schema::create('beneficiaries', function (Blueprint $table) {
            $table->id();
            $table->string('application_ref')->unique();
            $table->string('full_name');
            $table->string('email')->nullable();
            $table->string('phone');
            $table->string('nic_or_id')->nullable();
            $table->text('address')->nullable();
            $table->string('category')->default('Emergency Relief');
            $table->integer('family_members_count')->default(1);
            $table->decimal('monthly_income', 10, 2)->nullable();
            $table->text('assistance_requested');
            $table->string('status')->default('pending'); // pending, under_review, approved, rejected, completed
            $table->text('review_notes')->nullable();
            $table->string('assigned_staff')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beneficiaries');
    }
};
