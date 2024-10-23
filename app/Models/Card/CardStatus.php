<?php

namespace App\Models\Card;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CardStatus extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'visibility'];

    protected $casts = [
        'visibility' => 'boolean'
    ];

    public function cards(): HasMany
    {
        return $this->hasMany(Card::class);
    }
}
