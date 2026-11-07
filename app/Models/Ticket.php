<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    protected $fillable = [
        'event_id',
        'name',
        'price',
        'quantity',
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}