<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Parking extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_id', 'slot_count', 'parking_name','price', 'profile_img_path'
    ];

    // relationship with the User model
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function location()
    {
        return $this->hasOne(ParkingLocation::class);
    }

    public function sessions()
    {
        return $this->hasMany(ParkingSession::class, 'parking_id');
    }
    
    public function images(): HasMany
    {
        return $this->hasMany(ParkingImage::class);
    }
}
