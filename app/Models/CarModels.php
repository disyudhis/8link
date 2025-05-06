<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CarModels extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_category_id',
        'name',
        'brand',
        'description',
    ];

    public function category()
    {
        return $this->belongsTo(CarCategories::class, 'car_category_id');
    }

    public function bookings()
    {
        return $this->hasMany(Bookings::class);
    }
}