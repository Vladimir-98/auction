<?php

namespace App\Filament\Resources\CardResource\Pages;

use App\Models\Card\Card;
use Illuminate\Database\Eloquent\Model;
use App\Filament\Resources\CardResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCard extends CreateRecord
{
    protected static string $resource = CardResource::class;


}
