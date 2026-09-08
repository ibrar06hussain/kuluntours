<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'country',
        'subject',
        'package_id',
        'travelers_count',
        'preferred_date',
        'message',
        'is_read',
        'status',
        'source',
        'admin_notes',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'preferred_date' => 'date',
        'travelers_count' => 'integer',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function scopeUnread($query)
    {
        return $query->where('status', 'new');
    }
}
