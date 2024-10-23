<?php

namespace App\Filament\Resources\CrmTokenResource\Pages;

use App\Filament\Resources\CrmTokenResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCrmTokens extends ListRecords
{
    protected static string $resource = CrmTokenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
