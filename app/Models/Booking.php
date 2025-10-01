<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'username',
        'email',
        'phone',
        'booking_time',
        'booking_date',
        'guests',
        'special_requests',
        'table_preference',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);

    }
}
