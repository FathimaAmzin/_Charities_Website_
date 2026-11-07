<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'description',
        'target_amount',
        'amount_raised',
        'current_donations',
        'start_date',
        'end_date',
        'status',
        'image',
        'featured',
        'donor_count',
    ];

    protected $casts = [
        'target_amount' => 'decimal:2',
        'amount_raised' => 'decimal:2',
        'current_donations' => 'decimal:2',
        'featured' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    public function getProgressPercentAttribute(): int
    {
        if (!$this->target_amount || $this->target_amount <= 0) {
            return 0;
        }
        $pct = round(($this->amount_raised / $this->target_amount) * 100);
        return min(100, (int)$pct);
    }

    public function getImageUrlAttribute(): string
    {
        if (!empty($this->image)) {
            if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://')) {
                return $this->image;
            }
            return asset($this->image);
        }
        return 'https://images.unsplash.com/photo-1532629345422-7515f3d16bb7?auto=format&fit=crop&w=900&q=80';
    }
}
