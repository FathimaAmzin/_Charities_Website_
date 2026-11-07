<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'service_id',
        'type',
        'course_title',
        'full_name',
        'phone',
        'email',
        'nic',
        'district',
        'city',
        'education_level',
        'preferred_schedule',
        'message',
        'status',
        'is_read',
        'admin_notes',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeCourses($query)
    {
        return $query->where('type', 'course');
    }

    public function scopeServices($query)
    {
        return $query->where('type', 'service');
    }

    public function getStatusBadgeAttribute(): string
    {
        return match ($this->status) {
            'pending' => '<span class="badge bg-warning text-dark"><i class="fa-solid fa-clock me-1"></i>Pending</span>',
            'contacted' => '<span class="badge bg-info text-white"><i class="fa-solid fa-phone me-1"></i>Contacted</span>',
            'approved' => '<span class="badge bg-success"><i class="fa-solid fa-circle-check me-1"></i>Approved / Enrolled</span>',
            'completed' => '<span class="badge bg-primary"><i class="fa-solid fa-graduation-cap me-1"></i>Completed</span>',
            'rejected' => '<span class="badge bg-danger"><i class="fa-solid fa-circle-xmark me-1"></i>Rejected</span>',
            default => '<span class="badge bg-secondary">' . ucfirst($this->status) . '</span>',
        };
    }
}

