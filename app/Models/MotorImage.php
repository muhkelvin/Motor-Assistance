<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MotorImage extends Model
{
    /** @use HasFactory<\Database\Factories\MotorImageFactory> */
    use HasFactory;

    protected $fillable = [
        'motor_id',
        'image_path',
        'image_type',
        'alt_text',
        'sort_order'
    ];

    protected $casts = [
        'sort_order' => 'integer'
    ];

    public function motor()
    {
        return $this->belongsTo(Motor::class);
    }

    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image_path);
    }

    public function scopeGallery($query)
    {
        return $query->where('image_type', 'gallery');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }}
