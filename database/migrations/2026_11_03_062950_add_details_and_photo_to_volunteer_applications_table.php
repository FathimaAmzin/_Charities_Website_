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
        Schema::table('volunteer_applications', function (Blueprint $table) {
            $table->text('address')->nullable()->after('full_name');
            $table->date('date_of_birth')->nullable()->after('phone');
            $table->unsignedInteger('age')->nullable()->after('date_of_birth');
            $table->string('nic_no', 40)->nullable()->after('age');
            $table->string('education_qualification')->nullable()->after('nic_no');
            $table->string('occupation', 150)->nullable()->after('education_qualification');
            $table->text('other_qualification')->nullable()->after('occupation');
            $table->string('photo')->nullable()->after('other_qualification');

            // Make previous columns nullable to support flexible applications
            $table->string('email')->nullable()->change();
            $table->string('country')->nullable()->change();
            $table->string('skills')->nullable()->change();
            $table->string('area_of_interest')->nullable()->change();
            $table->string('availability')->nullable()->change();
            $table->text('introduction')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('volunteer_applications', function (Blueprint $table) {
            $table->dropColumn([
                'address',
                'date_of_birth',
                'age',
                'nic_no',
                'education_qualification',
                'occupation',
                'other_qualification',
                'photo',
            ]);
        });
    }
};
