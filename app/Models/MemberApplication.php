<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'full_name',
        'address',
        'phone',
        'email',
        'date_of_birth',
        'age',
        'nic_no',
        'membership_type',
        'education_qualification',
        'occupation',
        'other_qualification',
        'photo',
        'statement',
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
     * Get member photo URL with reliable fallback avatar
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

        return 'https://ui-avatars.com/api/?name=' . urlencode($this->full_name ?: 'Member') . '&background=059669&color=fff&size=256&bold=true';
    }
}

