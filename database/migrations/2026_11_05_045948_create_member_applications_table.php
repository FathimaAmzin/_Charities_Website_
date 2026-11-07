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
        Schema::create('member_applications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->string('full_name', 150);
            $table->text('address');
            $table->string('phone', 40);
            $table->string('email', 150)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->unsignedInteger('age')->nullable();
            $table->string('nic_no', 40)->nullable()->index();
            $table->string('membership_type', 100)->default('General Member');
            $table->string('education_qualification', 255)->nullable();
            $table->string('occupation', 150)->nullable();
            $table->text('other_qualification')->nullable();
            $table->string('photo')->nullable();
            $table->text('statement')->nullable();
            $table->string('status', 40)->default('pending')->index();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_applications');
    }
};
