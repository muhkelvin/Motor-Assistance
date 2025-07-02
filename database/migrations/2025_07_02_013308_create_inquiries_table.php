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
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('city')->nullable();
            $table->enum('preferred_contact_time', ['morning', 'afternoon', 'evening', 'anytime'])->default('anytime');
            $table->foreignId('motor_id')->constrained()->cascadeOnDelete();
            $table->foreignId('credit_simulation_id')->nullable()->constrained()->nullOnDelete();
            $table->text('notes')->nullable();
            $table->enum('status', ['new', 'contacted', 'qualified', 'closed'])->default('new');
            $table->timestamp('contacted_at')->nullable();
            $table->string('source')->default('website'); // website, social_media, etc
            $table->timestamps();

            $table->index(['status', 'created_at']);
            $table->index('phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquiries');
    }
};
