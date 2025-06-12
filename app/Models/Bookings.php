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

    protected $fillable = ['customer_id', 'package_price_id', 'license_plate', 'car_name', 'car_color', 'booking_date', 'status', 'total_price', 'notes', 'queue_number', 'assigned_worker_id', 'assigned_at', 'started_at', 'completed_at'];

    protected $casts = [
        'booking_date' => 'date',
        'assigned_at' => 'datetime',
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
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

    public function assignedWorker()
    {
        return $this->belongsTo(Worker::class, 'assigned_worker_id');
    }

    public function getStatusColorAttribute()
    {
        switch ($this->status) {
            case self::STATUS_PENDING:
                return 'bg-yellow-100 text-yellow-800';
            case self::STATUS_CONFIRMED:
                return 'bg-blue-100 text-blue-800';
            case self::STATUS_PROGRESS:
                return 'bg-green-100 text-green-800';
            case self::STATUS_COMPLETED:
                return 'bg-gray-100 text-gray-800';
            case self::STATUS_CANCELLED:
                return 'bg-red-100 text-red-800';
            default:
                return 'bg-gray-100 text-gray-800';
        }
    }

    public function getStatusTextAttribute()
    {
        switch ($this->status) {
            case self::STATUS_PENDING:
                return 'Pending';
            case self::STATUS_CONFIRMED:
                return 'Confirmed';
            case self::STATUS_PROGRESS:
                return 'In Progress';
            case self::STATUS_COMPLETED:
                return 'Completed';
            case self::STATUS_CANCELLED:
                return 'Cancelled';
            default:
                return 'Unknown';
        }
    }

    public function getDurationAttribute()
    {
        if ($this->started_at && $this->completed_at) {
            return $this->started_at->diffForHumans($this->completed_at, true);
        }

        if ($this->started_at) {
            return $this->started_at->diffForHumans(now(), true) . ' (ongoing)';
        }

        return null;
    }

    public function getEstimatedCompletionAttribute()
    {
        if ($this->started_at && !$this->completed_at) {
            // Estimate based on package type (you can adjust these estimates)
            $estimatedHours = 2; // Default 2 hours

            if ($this->packagePrice && $this->packagePrice->servicePackage) {
                $packageName = strtolower($this->packagePrice->servicePackage->name);

                if (str_contains($packageName, 'premium') || str_contains($packageName, 'full')) {
                    $estimatedHours = 4;
                } elseif (str_contains($packageName, 'basic') || str_contains($packageName, 'touch up')) {
                    $estimatedHours = 1;
                }
            }

            return $this->started_at->addHours($estimatedHours);
        }

        return null;
    }
}