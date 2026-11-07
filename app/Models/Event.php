<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'image',
        'event_date',
        'event_time',
        'location',
        'registration_deadline',
        'status',
    ];

    protected $casts = [
        'event_date' => 'date',
        'registration_deadline' => 'date',
    ];

    public function registrations()
    {
        return $this->hasMany(EventRegistration::class);
    }

    public function getImageUrlAttribute(): string
    {
        if (!empty($this->image)) {
            if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://')) {
                return $this->image;
            }
            return asset($this->image);
        }
        return 'https://images.unsplash.com/photo-1511632765486-a01980e01a18?auto=format&fit=crop&w=900&q=80';
    }
}
