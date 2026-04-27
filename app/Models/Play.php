<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Play extends Model
{
    /** @use HasFactory<\Database\Factories\PlaysFactory> */
    use HasFactory;

    protected $fillable = [
        'movie_id',
        'hall_id',
        'starts_at',
        'price',
    ];

    public function hall(): BelongsTo
    {
        return $this->belongsTo(Hall::class);
    }
    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }
}
