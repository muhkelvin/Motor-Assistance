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
        Schema::create('motor_installments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('motor_id')->constrained('motors')->cascadeOnDelete();
            $table->decimal('down_payment', 15, 2);
            $table->integer('tenor_months'); // misal: 11, 17, 23, 29, 35
            $table->decimal('installment_amount', 15, 2); // cicilan per bulan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('motor_installments');
    }
};
