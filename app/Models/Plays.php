<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Plays extends Model
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
        return $this->belongsTo(Halls::class);
    }
    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movies::class);
    }
}
