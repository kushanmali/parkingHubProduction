<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkingSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id', 
        'parking_id', 
        'start_time', 
        'end_time', 
        'status', 
        'billing_price'
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    // Define the relationship with the User model (customer)
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    // Define the relationship with the Parking model
    public function parking()
    {
        return $this->belongsTo(Parking::class, 'parking_id');
    }
}
