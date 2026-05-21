<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Play extends Model
{
    /** @use HasFactory<\Database\Factories\PlayFactory> */
    use HasFactory;

    use HasUuids;
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'movie_id',
        'hall_id',
        'start_date',
        'start_time',
        'standard_price',
        'vip_price',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
        ];
    }

    public function freeSeatsCount()
    {
        $total = $this->hall->seats()->count();
        $occupied = $this->tickets()->count();
        $inCarts = $this->cartItems()->count();
        return $total - ($occupied + $inCarts);
    }

    public function hall(): BelongsTo
    {
        return $this->belongsTo(Hall::class);
    }
    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }
    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }
    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }
}
