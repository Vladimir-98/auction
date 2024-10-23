<?php

namespace App\Models\Card;

use App\Http\Resources\PaymentTypeResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PaymentType extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function cards(): BelongsToMany
    {
        return $this->belongsToMany(
            Card::class,
            'card_payment_type',
            'payment_type_id',
            'card_id'
        );
    }

    public static function getAllCollection(): ResourceCollection
    {
        return PaymentTypeResource::collection(self::all());
    }
}
