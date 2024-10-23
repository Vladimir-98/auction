<?php

namespace App\Filament\Resources\CrmTokenResource\Pages;

use App\Filament\Resources\CrmTokenResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCrmToken extends EditRecord
{
    protected static string $resource = CrmTokenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
