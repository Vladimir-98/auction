<?php


namespace App\Filament\Actions\Card;

use Filament\Forms;
use App\Models\Card\Card;
use Filament\Tables\Actions\BulkAction;

class ChangeStatusAction extends BulkAction
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->label('Изменить статус')
            ->form([
                Forms\Components\Select::make('status_id')
                    ->label(__('fields.card.status_id'))
                    ->relationship('status', 'name')
                    ->default(null),
            ])
            ->action(function ($records, array $data): void {
                Card::query()->whereIn('id', $records->pluck('id'))->update($data);
            });
    }
}
