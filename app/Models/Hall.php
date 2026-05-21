<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hall extends Model
{
    /** @use HasFactory<\Database\Factories\HallFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        'rows_count',
        'columns_count',
    ];
    public function getTotalCapacity()
    {
        return $this->rows_count * $this->columns_count;
    }
    public function getSeatingPlan()
    {
        return $this->seats()
            ->orderBy('row', 'desc')
            ->orderBy('column')
            ->get()
            ->groupBy('row');
    }
    public function seats(): HasMany
    {
        return $this->hasMany(Seat::class);
    }

    public function plays(): HasMany
    {
        return $this->hasMany(Play::class);
    }
}
