<?php


namespace App\Filament\Actions\Card;

use Filament\Forms;
use App\Models\Card\Card;
use Filament\Tables\Actions\BulkAction;

class ChangeLeadPriceAction extends BulkAction
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->label('Изменить цену за лид')
            ->form([
                Forms\Components\TextInput::make('lead_price')
                    ->label('Новая цена за лид')
                    ->numeric()
                    ->required(),
            ])
            ->action(function ($records, array $data): void {
                Card::query()->whereIn('id', $records->pluck('id'))->update($data);
            });
    }
}
