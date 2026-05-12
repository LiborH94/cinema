<?php

namespace App\Models;

use App\TicketStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    use HasUuids;
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'play_id',
        'seat_id',
        'price_paid',
    ];

    protected function casts(): array
    {
        return [

        ];
    }

    public function play(): BelongsTo
    {
        return $this->belongsTo(Play::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function seat(): BelongsTo
    {
        return $this->belongsTo(Seat::class);
    }
}
