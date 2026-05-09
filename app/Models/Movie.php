<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movie extends Model
{
    /** @use HasFactory<\Database\Factories\MovieFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'image_path',
        'image',
    ];

    public function plays(): HasMany
    {
        return $this->hasMany(Play::class);
    }
}
