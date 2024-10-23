<?php


namespace App\Filament\Actions\Client;

use Filament\Forms;
use App\Models\Client\Client;
use Filament\Tables\Actions\BulkAction;

class ChangeStatusAction extends BulkAction
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->label('Изменить статус')
            ->form([
                Forms\Components\Select::make('status_id')
                    ->label(__('fields.client.status_id'))
                    ->relationship('status', 'name')
                    ->default(null),
            ])
            ->action(function ($records, array $data): void {
                Client::query()->whereIn('id', $records->pluck('id'))->update($data);
            });
    }
}
