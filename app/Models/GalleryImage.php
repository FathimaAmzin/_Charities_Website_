<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'description',
        'image_path',
        'order',
    ];

    public function getImageUrlAttribute(): string
    {
        if (!empty($this->image_path)) {
            if (str_starts_with($this->image_path, 'http://') || str_starts_with($this->image_path, 'https://')) {
                return $this->image_path;
            }
            if (file_exists(public_path($this->image_path))) {
                return asset($this->image_path);
            }
        }

        // High quality category-based NGO fallback photography
        $categoryFallbacks = [
            'Clean Water' => 'https://images.unsplash.com/photo-1541252260730-0412e8e2108e?auto=format&fit=crop&w=900&q=80',
            'Education' => 'https://images.unsplash.com/photo-1497633762265-9d179a990aa6?auto=format&fit=crop&w=900&q=80',
            'Vocational Training' => 'https://images.unsplash.com/photo-1581092921461-eab62e97a780?auto=format&fit=crop&w=900&q=80',
            'Healthcare' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=900&q=80',
            'Community Outreach' => 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?auto=format&fit=crop&w=900&q=80',
            'Events' => 'https://images.unsplash.com/photo-1511632765486-a01980e01a18?auto=format&fit=crop&w=900&q=80',
        ];

        return $categoryFallbacks[$this->category] ?? 'https://images.unsplash.com/photo-1509099836639-18ba1795216d?auto=format&fit=crop&w=900&q=80';
    }
}
