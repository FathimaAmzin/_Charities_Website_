<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'role',
        'category',
        'badge',
        'image',
        'bio',
        'email',
        'phone',
        'linkedin',
        'order',
        'status',
    ];

    protected $casts = [
        'order' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeBoardOfDirectors($query)
    {
        return $query->where('category', 'board_of_directors');
    }

    public function scopeManagingExecutives($query)
    {
        return $query->where('category', 'managing_executives');
    }
}

