<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{
    protected $fillable = [
        'customer_id',
        'package_price_id',
        'license_plate',
        'car_name',
        'car_color',
        'booking_date',
        'status',
        'total_price',
        'notes',
    ];
}