<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageInclusion extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_id',
        'type',
        'description',
        'sort_order',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function scopeInclusions($query)
    {
        return $query->where('type', 'inclusion');
    }

    public function scopeExclusions($query)
    {
        return $query->where('type', 'exclusion');
    }
}
