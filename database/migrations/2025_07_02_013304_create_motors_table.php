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
        Schema::create('motors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->decimal('price', 15, 2);
            $table->string('model_year');
            $table->integer('engine_cc');
            $table->json('colors'); // Store array of colors
            $table->json('specifications'); // Store detailed specs as JSON
            $table->json('features')->nullable(); // CBS, ABS, Smart Key, etc.
            $table->text('description')->nullable();
            $table->string('fuel_type')->default('Gasoline');
            $table->string('transmission')->default('Automatic');
            $table->decimal('fuel_capacity', 4, 1)->nullable(); // in liters
            $table->string('main_image')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('motors');
    }
};
