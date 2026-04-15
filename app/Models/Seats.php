<?php

namespace App\Models;

use App\SeatType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Seats extends Model
{
    /** @use HasFactory<\Database\Factories\SeatsFactory> */
    use HasFactory;

    public function casts()
    {
        return [
            'seat_type' => SeatType::class,
        ];
    }

    public function Hall(): BelongsTo
    {
        return $this->belongsTo(Halls::class);
    }
}
