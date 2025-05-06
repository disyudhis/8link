<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicePackages extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    public function packagePrices()
    {
        return $this->hasMany(PackagePrices::class, 'service_package_id');
    }
}