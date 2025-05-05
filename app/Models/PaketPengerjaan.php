<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaketPengerjaan extends Model
{
    protected $fillable = [
        'name',
        'description',
        'start_price',
        'end_price',
        'sizes',
    ];
}