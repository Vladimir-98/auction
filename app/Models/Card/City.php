<?php

namespace App\Models\Card;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class City extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function cards(): BelongsToMany
    {
        return $this->belongsToMany(
            Card::class,
            'card_city',
            'city_id',
            'card_id'
        );
    }
}
