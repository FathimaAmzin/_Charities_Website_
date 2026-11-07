<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'title',
        'message',
        'link',
        'icon',
        'badge_class',
        'is_read',
        'data',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'data' => 'array',
    ];

    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    public function scopeRecent($query, $limit = 10)
    {
        return $query->latest()->take($limit);
    }

    /**
     * Dispatch and log an admin notification with icon and link.
     */
    public static function notify(
        string $type,
        string $title,
        string $message,
        ?string $link = null,
        string $icon = 'fa-solid fa-bell',
        string $badgeClass = 'bg-primary text-white',
        array $data = []
    ): self {
        return self::create([
            'type' => $type,
            'title' => $title,
            'message' => $message,
            'link' => $link,
            'icon' => $icon,
            'badge_class' => $badgeClass,
            'is_read' => false,
            'data' => !empty($data) ? $data : null,
        ]);
    }
}

