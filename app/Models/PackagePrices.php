<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackagePrices extends Model
{
    protected $fillable = [
        'service_package_id',
        'car_category_id',
        'price',
    ];

    public function servicePackage()
    {
        return $this->belongsTo(ServicePackages::class, 'service_package_id');
    }
    public function carCategory()
    {
        return $this->belongsTo(CarCategories::class, 'car_category_id');
    }
}