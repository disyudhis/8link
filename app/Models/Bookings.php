<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{
    const STATUS_PENDING = 'pending';
    const STATUS_CONFIRMED = 'confirmed';
    const STATUS_PROGRESS = 'in_progress';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELLED = 'cancelled';

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
        'queue_number',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function packagePrice()
    {
        return $this->belongsTo(PackagePrices::class, 'package_price_id');
    }

    public function checklist()
    {
        return $this->hasOne(Checklist::class, 'booking_id');
    }

    public function getStatusColorAttribute()
    {
        if ($this->status == self::STATUS_PENDING) {
            return 'bg-yellow-100';
        } elseif ($this->status == self::STATUS_CONFIRMED) {
            return 'bg-blue-300';
        } elseif ($this->status == self::STATUS_PROGRESS) {
            return 'bg-green-100';
        } elseif ($this->status == self::STATUS_COMPLETED) {
            return 'bg-gray-300';
        } elseif ($this->status == self::STATUS_CANCELLED) {
            return 'bg-red-300';
        }
    }

    public function getStatusTextAttribute()
    {
        if ($this->status == self::STATUS_PENDING) {
            return 'Pending';
        } elseif ($this->status == self::STATUS_CONFIRMED) {
            return 'Confirmed';
        } elseif ($this->status == self::STATUS_PROGRESS) {
            return 'In Progress';
        } elseif ($this->status == self::STATUS_COMPLETED) {
            return 'Completed';
        } elseif ($this->status == self::STATUS_CANCELLED) {
            return 'Cancelled';
        }
    }
}
