<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolunteerApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'full_name',
        'address',
        'phone',
        'date_of_birth',
        'age',
        'nic_no',
        'education_qualification',
        'occupation',
        'other_qualification',
        'photo',
        'email',
        'country',
        'skills',
        'area_of_interest',
        'availability',
        'introduction',
        'status',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'age' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get volunteer photo URL with reliable avatar fallback
     */
    public function getPhotoUrlAttribute()
    {
        if ($this->photo) {
            if (str_starts_with($this->photo, 'http://') || str_starts_with($this->photo, 'https://')) {
                return $this->photo;
            }
            if (file_exists(public_path($this->photo))) {
                return asset($this->photo);
            }
            if (file_exists(public_path('storage/' . $this->photo))) {
                return asset('storage/' . $this->photo);
            }
            return asset($this->photo);
        }

        return 'https://ui-avatars.com/api/?name=' . urlencode($this->full_name ?: 'Volunteer') . '&background=0059FF&color=fff&size=256&bold=true';
    }
}
