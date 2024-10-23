<?php

namespace App\Filament\Resources\CardResource\Pages;

use App\Filament\Resources\CardResource;
use App\Models\Card\Card;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListCards extends ListRecords
{
    protected static string $resource = CardResource::class;

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

            'waiting' => Tab::make('Ожидает')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status_id', '=', '1'))
                ->badge(Card::query()->where('status_id', '=', '1')->count()),

            'public' => Tab::make('Публичная')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status_id', '=', '2'))
                ->badge(Card::query()->where('status_id', '=', '2')->count()),

            'sold' => Tab::make('Продана')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status_id', '=', '3'))
                ->badge(Card::query()->where('status_id', '=', '3')->count()),

            'expired' => Tab::make('Просрочена')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status_id', '=', '3'))
                ->badge(Card::query()->where('status_id', '=', '4')->count()),
        ];
    }
}
