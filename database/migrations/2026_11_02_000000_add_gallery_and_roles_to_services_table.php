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
        Schema::table('services', function (Blueprint $table) {
            if (!Schema::hasColumn('services', 'provide_title')) {
                $table->string('provide_title')->nullable()->after('provide_details');
            }
            if (!Schema::hasColumn('services', 'gallery')) {
                $table->json('gallery')->nullable()->after('highlights');
            }
            if (!Schema::hasColumn('services', 'servicing_roles')) {
                $table->json('servicing_roles')->nullable()->after('gallery');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            if (Schema::hasColumn('services', 'provide_title')) {
                $table->dropColumn('provide_title');
            }
            if (Schema::hasColumn('services', 'gallery')) {
                $table->dropColumn('gallery');
            }
            if (Schema::hasColumn('services', 'servicing_roles')) {
                $table->dropColumn('servicing_roles');
            }
        });
    }
};

