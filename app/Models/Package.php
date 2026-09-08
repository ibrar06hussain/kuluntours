<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'short_description',
        'description',
        'featured_image',
        'duration_days',
        'max_altitude',
        'difficulty_level',
        'best_season',
        'group_size',
        'starting_point',
        'ending_point',
        'price',
        'price_note',
        'is_featured',
        'is_fixed_departure',
        'departure_date',
        'meta_title',
        'meta_description',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'is_fixed_departure' => 'boolean',
        'price' => 'decimal:2',
        'departure_date' => 'date',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(PackageImage::class)->orderBy('sort_order');
    }

    public function itineraries()
    {
        return $this->hasMany(PackageItinerary::class)->orderBy('day_number');
    }

    public function inclusions()
    {
        return $this->hasMany(PackageInclusion::class)->where('type', 'inclusion')->orderBy('sort_order');
    }

    public function exclusions()
    {
        return $this->hasMany(PackageInclusion::class)->where('type', 'exclusion')->orderBy('sort_order');
    }

    public function allInclusions()
    {
        return $this->hasMany(PackageInclusion::class)->orderBy('sort_order');
    }

    public function inquiries()
    {
        return $this->hasMany(Inquiry::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true)->where('is_active', true);
    }

    public function scopeFixedDeparture($query)
    {
        return $query->where('is_fixed_departure', true)->where('is_active', true);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
