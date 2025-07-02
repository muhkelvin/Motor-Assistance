<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeasingCompany extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'interest_rate',
        'admin_fee',
        'terms_conditions',
        'is_active',
        'logo'
    ];

    protected $casts = [
        'interest_rate' => 'decimal:2',
        'admin_fee' => 'decimal:2',
        'is_active' => 'boolean'
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function creditSimulations()
    {
        return $this->hasMany(CreditSimulation::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

}
