<?php

namespace App\Models\Card;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CallRecord extends Model
{
    use HasFactory;

    protected $fillable = ['card_id', 'record'];

    public function card(): BelongsTo
    {
        return $this->belongsTo(Card::class);
    }
}
