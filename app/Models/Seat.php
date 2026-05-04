<?php

namespace App\Models;

use App\SeatType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Seat extends Model
{
    /** @use HasFactory<\Database\Factories\SeatsFactory> */
    use HasFactory;

    protected $fillable = [
        'hall_id',
        'row',
        'column',
        'type'
    ];

    public function casts()
    {
        return [
            'type' => SeatType::class,
        ];
    }

    public function Hall(): BelongsTo
    {
        return $this->belongsTo(Hall::class);
    }
}
