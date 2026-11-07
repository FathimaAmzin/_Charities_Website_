<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'title',
        'short_title',
        'category',
        'type',
        'icon',
        'accent_color',
        'image',
        'support_image',
        'request_image',
        'provide_image',
        'support_details',
        'request_details',
        'provide_details',
        'provide_title',
        'summary',
        'description',
        'highlights',
        'gallery',
        'servicing_roles',
        'servicing_cards',
        'impact',
        'course_duration',
        'course_level',
        'status',
        'order',
    ];

    protected $casts = [
        'highlights' => 'array',
        'gallery' => 'array',
        'servicing_roles' => 'array',
        'servicing_cards' => 'array',
        'order' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeServicesOnly($query)
    {
        return $query->where('type', 'service');
    }

    public function scopeCoursesOnly($query)
    {
        return $query->where('type', 'course');
    }
}

