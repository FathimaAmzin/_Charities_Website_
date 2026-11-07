<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_ref',
        'full_name',
        'email',
        'phone',
        'nic_or_id',
        'address',
        'category',
        'family_members_count',
        'monthly_income',
        'assistance_requested',
        'status',
        'review_notes',
        'assigned_staff',
    ];

    protected $casts = [
        'monthly_income' => 'decimal:2',
        'family_members_count' => 'integer',
    ];

    public function getStatusBadgeAttribute(): string
    {
        return match($this->status) {
            'pending' => 'bg-warning text-dark',
            'under_review' => 'bg-info text-white',
            'approved' => 'bg-success text-white',
            'rejected' => 'bg-danger text-white',
            'completed' => 'bg-secondary text-white',
            default => 'bg-light text-dark',
        };
    }
}
