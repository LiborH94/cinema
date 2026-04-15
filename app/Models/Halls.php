<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Halls extends Model
{
    /** @use HasFactory<\Database\Factories\HallsFactory> */
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
    public function seats(): HasMany
    {
        return $this->hasMany(Seats::class);
    }
}
