<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    protected $fillable = [
        'booking_id',
        'front_bumper',
        'rear_bumper',
        'hood',
        'roof',
        'left_side',
        'right_side',
        'notes'
    ];

    public function booking()
    {
        return $this->belongsTo(Bookings::class, 'booking_id');
    }
}
