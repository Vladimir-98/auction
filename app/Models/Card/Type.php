<?php

namespace App\Models\Card;

use App\Http\Resources\TypeResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Type extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name', 'icon', 'visibility'];

    protected $casts = [
        'visibility' => 'boolean'
    ];

    public function cards(): BelongsToMany
    {
        return $this->belongsToMany(
            Card::class,
            'card_type',
            'type_id',
            'card_id'
        );
    }

    public static function getAllCollection(): ResourceCollection
    {
        $types = self::query()->where('visibility', true)->get();
        return TypeResource::collection($types);
    }
}
