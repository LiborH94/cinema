<?php

namespace App\Models;

use App\SeatType;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItem extends Model
{
    /** @use HasFactory<\Database\Factories\CartItemFactory> */
    use HasFactory;
    use HasFactory, HasUuids;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'user_id',
        'play_id',
        'seat_id',
    ];

    public function getPriceAttribute(): int
    {
        return $this->seat->type === SeatType::VIP
            ? $this->play->vip_price
            : $this->play->standard_price;
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function seat(): BelongsTo
    {
        return $this->belongsTo(Seat::class);
    }

    public function play(): BelongsTo
    {
        return $this->belongsTo(Play::class);
    }
}
