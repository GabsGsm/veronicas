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
        Schema::create('home_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('home_container_id')->constrained()->cascadeOnDelete();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('component_type')->default('cards');
            $table->string('data_source')->default('products');
            $table->string('filter_type')->default('all');
            $table->json('filter_values')->nullable();
            $table->string('order_by')->default('newest');
            $table->integer('limit')->default(4);
            $table->boolean('show_title')->default(true);
            $table->boolean('show_view_all')->default(false);
            $table->string('view_all_label')->default('Ver mais');
            $table->string('view_all_url')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_sections');
    }
};
