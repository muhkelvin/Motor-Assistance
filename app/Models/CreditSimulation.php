<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditSimulation extends Model
{
    /** @use HasFactory<\Database\Factories\CreditSimulationFactory> */
    use HasFactory;

    protected $fillable = [
        'motor_id',
        'leasing_company_id',
        'motor_price',
        'down_payment',
        'tenor_months',
        'interest_rate',
        'monthly_payment',
        'total_payment',
        'total_interest',
        'insurance_fee',
        'admin_fee',
        'additional_costs',
        'session_id'
    ];

    protected $casts = [
        'motor_price' => 'decimal:2',
        'down_payment' => 'decimal:2',
        'tenor_months' => 'integer',
        'interest_rate' => 'decimal:2',
        'monthly_payment' => 'decimal:2',
        'total_payment' => 'decimal:2',
        'total_interest' => 'decimal:2',
        'insurance_fee' => 'decimal:2',
        'admin_fee' => 'decimal:2',
        'additional_costs' => 'decimal:2'
    ];

    public function motor()
    {
        return $this->belongsTo(Motor::class);
    }

    public function leasingCompany()
    {
        return $this->belongsTo(LeasingCompany::class);
    }

    public function inquiry()
    {
        return $this->hasOne(Inquiry::class);
    }

    public function installment()
    {
        return $this->belongsTo(MotorInstallment::class, 'installment_id');
    }

    public function getLoanAmountAttribute()
    {
        return $this->motor_price - $this->down_payment;
    }

    public function getFormattedMonthlyPaymentAttribute()
    {
        return 'Rp ' . number_format($this->monthly_payment, 0, ',', '.');
    }

    public function getFormattedTotalPaymentAttribute()
    {
        return 'Rp ' . number_format($this->total_payment, 0, ',', '.');
    }


    }
