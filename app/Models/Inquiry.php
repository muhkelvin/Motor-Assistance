<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    /** @use HasFactory<\Database\Factories\InquiryFactory> */
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'phone',
        'email',
        'city',
        'preferred_contact_time',
        'motor_id',
        'credit_simulation_id',
        'notes',
        'status',
        'contacted_at',
        'source'
    ];

    protected $casts = [
        'contacted_at' => 'datetime'
    ];

    public function motor()
    {
        return $this->belongsTo(Motor::class);
    }

    public function creditSimulation()
    {
        return $this->belongsTo(CreditSimulation::class);
    }

    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function markAsContacted()
    {
        $this->update([
            'status' => 'contacted',
            'contacted_at' => now()
        ]);
    }

    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'new' => 'Baru',
            'contacted' => 'Dihubungi',
            'qualified' => 'Berkualitas',
            'closed' => 'Ditutup',
            default => 'Unknown'
        };
    }

    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'new' => 'info',
            'contacted' => 'warning',
            'qualified' => 'success',
            'closed' => 'secondary',
            default => 'primary'
        };
    }}
