<?php

namespace App\Models;

use App\CartStatus;
use App\SeatType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    /** @use HasFactory<\Database\Factories\CartFactory> */
    use HasFactory;

    public function casts()
    {
        return [
            'status' => CartStatus::class,
        ];
    }
    protected $fillable = [
        'user_id',
        'status',
    ];

    public function priceTotal()
    {
        $total = 0;
        foreach ($this->items as $item) {
            $total += match($item->seat->type) {
                SeatType::VIP => $item->seat->vip_price,
                default => $item->seat->standard_price,
            };
        }
        return $total;
    }

    public function items(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

