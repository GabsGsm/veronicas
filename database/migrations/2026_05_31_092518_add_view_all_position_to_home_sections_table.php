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
        Schema::table('home_sections', function (Blueprint $table) {
            $table->string('view_all_position')->default('inline')->after('view_all_url');
        });
    }

    public function down(): void
    {
        Schema::table('home_sections', function (Blueprint $table) {
            $table->dropColumn('view_all_position');
        });
    }
};
