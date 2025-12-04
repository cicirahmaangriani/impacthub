<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventMaterial extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'title',
        'description',
        'file_path',
        'file_type',
        'file_size',
        'order',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
