<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkingLocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'parking_id', 'address_address', 'address_latitude', 'address_longitude'
    ];

    public function parking()
    {
        return $this->belongsTo(Parking::class);
    }
}
