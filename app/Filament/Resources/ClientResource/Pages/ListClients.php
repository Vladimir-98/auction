<?php

namespace App\Filament\Resources\ClientResource\Pages;

use App\Filament\Resources\ClientResource;
use App\Models\Client\Client;
use Filament\Actions;
use Filament\Forms\Form;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListClients extends ListRecords
{
    protected static string $resource = ClientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    // Вкалдки над таблицей
    public function getTabs(): array
    {
        return [
            'all' => Tab::make('Все'),

            'archive' => Tab::make('Активные')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status_id', '=', '1'))
                ->badge(Client::query()->where('status_id', '=', '1')->count()),

            'active' => Tab::make('Не активные')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status_id', '=', '2'))
                ->badge(Client::query()->where('status_id', '=', '2')->count()),

            'inactive' => Tab::make('Архивные')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status_id', '=', '3'))
                ->badge(Client::query()->where('status_id', '=', '3')->count()),
        ];
    }
}
