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
        Schema::create('credit_simulations', function (Blueprint $table) {
            $table->id(); // Tambahkan ID sebagai primary key jika belum ada
            $table->foreignId('motor_id')->constrained()->cascadeOnDelete();
            $table->foreignId('leasing_company_id')->constrained()->cascadeOnDelete();
            $table->decimal('motor_price', 15, 2);
            $table->decimal('down_payment', 15, 2);
            $table->integer('tenor_months'); // 12, 24, 36, 48, 60
            $table->decimal('interest_rate', 5, 2);
            $table->decimal('monthly_payment', 15, 2);
            $table->decimal('total_payment', 15, 2);
            $table->decimal('total_interest', 15, 2)->nullable();
            $table->decimal('insurance_fee', 15, 2)->default(0);
            $table->decimal('admin_fee', 15, 2)->default(0);
            $table->decimal('additional_costs', 15, 2)->default(0); // STNK, plat nomor, etc
            $table->string('session_id')->nullable(); // For guest users
            $table->timestamps();

            // Index dengan nama yang lebih pendek
            $table->index(['motor_id', 'leasing_company_id', 'tenor_months'], 'credit_sim_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credit_simulations');
    }
};
