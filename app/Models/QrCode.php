<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QrCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id', 'qr_code_path',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
}
