<?php

namespace App\Models;

use App\Models\Worker;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RfidCard extends Model
{
    use HasFactory;

    protected $fillable = ['card_id', 'worker_id', 'status', 'last_scanned_at'];

    protected $casts = [
        'last_scanned_at' => 'datetime',
    ];

    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }
}