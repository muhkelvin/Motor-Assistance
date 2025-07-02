<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motor extends Model
{
    /** @use HasFactory<\Database\Factories\MotorFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'category_id',
        'price',
        'model_year',
        'engine_cc',
        'colors',
        'specifications',
        'features',
        'description',
        'fuel_type',
        'transmission',
        'fuel_capacity',
        'main_image',
        'is_featured',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'engine_cc' => 'integer',
        'colors' => 'array',
        'specifications' => 'array',
        'features' => 'array',
        'fuel_capacity' => 'decimal:1',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'sort_order' => 'integer'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(MotorImage::class);
    }

    public function galleryImages()
    {
        return $this->hasMany(MotorImage::class)->where('image_type', 'gallery')->orderBy('sort_order');
    }

    public function creditSimulations()
    {
        return $this->hasMany(CreditSimulation::class);
    }

    public function inquiries()
    {
        return $this->hasMany(Inquiry::class);
    }

    public function motorinstallments()
    {
        return $this->hasMany(MotorInstallment::class);
    }
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    public function scopePriceRange($query, $min, $max)
    {
        return $query->whereBetween('price', [$min, $max]);
    }

    public function scopeEngineRange($query, $min, $max)
    {
        return $query->whereBetween('engine_cc', [$min, $max]);
    }

    public function scopeByYear($query, $year)
    {
        return $query->where('model_year', $year);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        });
    }

    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    public function getMainImageUrlAttribute()
    {
        return $this->main_image ? asset('storage/' . $this->main_image) : asset('images/default-motor.jpg');
    }



}
