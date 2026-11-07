<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';

    protected $fillable = [
        'title',
        'slug',
        'type',
        'event_date',
        'location',
        'summary',
        'content',
        'image',
        'published_at',
        'is_published',
    ];

    protected $casts = [
        'event_date' => 'datetime',
        'published_at' => 'datetime',
        'is_published' => 'boolean',
    ];

    public function getImageUrlAttribute(): string
    {
        if (!empty($this->image)) {
            if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://')) {
                return $this->image;
            }
            return asset($this->image);
        }

        // Return curated high-quality charity editorial photos
        $photos = [
            'event' => 'https://images.unsplash.com/photo-1511632765486-a01980e01a18?auto=format&fit=crop&w=900&q=80',
            'news' => 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?auto=format&fit=crop&w=900&q=80',
        ];

        return $photos[$this->type] ?? 'https://images.unsplash.com/photo-1509099836639-18ba1795216d?auto=format&fit=crop&w=900&q=80';
    }
}
