<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MotorInstallment extends Model
{
    /** @use HasFactory<\Database\Factories\MotorInstallmentFactory> */
    use HasFactory;

    protected $fillable = [
        'motor_id',
        'down_payment',
        'tenor_months',
        'installment_amount'

    ];

    protected $casts = [
        'down_payment' => 'float',
        'installment_amount' => 'float',
    ];

    public function motor()
    {
        return $this->belongsTo(Motor::class);
    }
}
