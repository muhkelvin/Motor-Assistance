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
        Schema::create('leasing_companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->decimal('interest_rate', 5, 2); // 5 digits, 2 decimal places (e.g., 12.50)
            $table->decimal('admin_fee', 12, 2)->default(0);
            $table->text('terms_conditions')->nullable();
            $table->boolean('is_active')->default(true);
            $table->string('logo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leasing_companies');
    }
};
