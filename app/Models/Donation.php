<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'project_id',
        'campaign_id',
        'donor_name',
        'email',
        'phone',
        'amount',
        'payment_method',
        'anonymous',
        'message',
        'status',
        'receipt_code',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'anonymous' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
