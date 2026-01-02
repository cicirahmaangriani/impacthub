<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventSchedule extends Model
{
    protected $fillable = [
        'event_id',
        'title',
        'description',
        'start_time',
        'end_time',
        'location',
        'image', 
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];
}
