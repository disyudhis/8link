<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Worker extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'rfid_tag', 'is_active', 'hire_date'];

    protected $casts = [
        'is_active' => 'boolean',
        'hire_date' => 'date',
    ];

    public function bookings()
    {
        return $this->hasMany(Bookings::class, 'assigned_worker_id');
    }

    public function activeBookings()
    {
        return $this->hasMany(Bookings::class, 'assigned_worker_id')->whereIn('status', [Bookings::STATUS_CONFIRMED, Bookings::STATUS_PROGRESS]);
    }

    public function completedBookings()
    {
        return $this->hasMany(Bookings::class, 'assigned_worker_id')->where('status', Bookings::STATUS_COMPLETED);
    }

    public function isAvailable()
    {
        return $this->is_active && $this->activeBookings()->count() == 0;
    }

    public function getCurrentBooking()
    {
        return $this->activeBookings()->first();
    }
}
