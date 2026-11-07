<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'location',
        'short_description',
        'description',
        'target_amount',
        'amount_raised',
        'start_date',
        'end_date',
        'status',
        'image',
        'featured',
    ];

    protected $casts = [
        'target_amount' => 'decimal:2',
        'amount_raised' => 'decimal:2',
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
        return 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?auto=format&fit=crop&w=900&q=80';
    }
}
