<?php

namespace App\Models\Card;

use App\Models\Filter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PriceLead extends Model
{
    use HasFactory;

    public static function getAllCollection(): array
    {
        return Filter::MIN_MAX;
    }
}
