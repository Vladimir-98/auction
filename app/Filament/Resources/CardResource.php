<?php

namespace App\Filament\Resources;

use App\Filament\Actions\Card\ChangeLeadPriceAction;
use App\Filament\Actions\Card\ChangeStatusAction;
use App\Filament\Resources\CardResource\Pages;
use App\Filament\Resources\CardResource\RelationManagers;
use App\Models\Card\Card;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CardResource extends Resource
{
    protected static ?string $model = Card::class;

    protected static ?string $modelLabel = "Лид";

    protected static ?string $pluralModelLabel = 'Лиды';

    protected static ?string $navigationGroup = 'Телеграм';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('fields.card.name'))
                    ->required()
                    ->maxLength(255),

                Forms\Components\Textarea::make('desc')
                    ->label(__('fields.card.desc')),

                Forms\Components\TextInput::make('phone')
                    ->label(__('fields.card.phone'))
                    ->tel()
                    ->maxLength(255)
                    ->default(null),

                Forms\Components\TextInput::make('lead_price')
                    ->label(__('fields.card.lead_price'))
                    ->numeric()
                    ->required()
                    ->default(null),

                Forms\Components\TextInput::make('budget_min')
                    ->label(__('fields.card.budget_min'))
                    ->numeric()
                    ->default(null),

                Forms\Components\TextInput::make('budget_max')
                    ->label(__('fields.card.budget_max'))
                    ->numeric()
                    ->default(null),

                Forms\Components\Select::make('city_id')
                    ->label(__('fields.filter.city'))
                    ->relationship('cities', 'name')
                    ->multiple()
                    ->preload()
                    ->default(null),

                Forms\Components\Select::make('districts')
                    ->label(__('fields.filter.districts'))
                    ->relationship('districts', 'name')
                    ->multiple()
                    ->preload(),

                Forms\Components\Select::make('types')
                    ->label(__('fields.filter.categories'))
                    ->relationship('types', 'name')
                    ->multiple()
                    ->preload(),

                Forms\Components\Select::make('payment_types')
                    ->label(__('fields.filter.paymentType'))
                    ->relationship('payment_types', 'name')
                    ->multiple()
                    ->preload(),

                Forms\Components\Select::make('status_id')
                    ->label(__('fields.card.status_id'))
                    ->relationship('status', 'name')
                    ->default(null),

                Forms\Components\TextInput::make('crm_id')
                    ->label(__('fields.card.crm_id'))
                    ->numeric()
                    ->default(null),

                Forms\Components\TextInput::make('crm_url')
                    ->label(__('fields.card.crm_url'))
                    ->string()
                    ->default(null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('fields.card.name'))
                    ->searchable(),

                Tables\Columns\TextColumn::make('status.name')
                    ->label(__('fields.card.status_id'))
                ->searchable(),

                Tables\Columns\TextColumn::make('phone')
                    ->label(__('fields.card.phone'))
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('crm_id')
                    ->label(__('fields.card.crm_id'))
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('crm_url')
                    ->label(__('fields.card.crm_url'))
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('budget_min')
                    ->label(__('fields.card.budget_min'))
                    ->numeric(),

                Tables\Columns\TextColumn::make('budget_max')
                    ->label(__('fields.card.budget_max'))
                    ->numeric(),

                Tables\Columns\TextColumn::make('lead_price')
                    ->label(__('fields.card.lead_price'))
                    ->numeric(),

                Tables\Columns\TextColumn::make('cities.name')
                    ->label(__('fields.filter.city')),

                Tables\Columns\BadgeColumn::make('districts.name')
                    ->label(__('fields.filter.districts')),

                Tables\Columns\BadgeColumn::make('types.name')
                    ->label(__('fields.filter.categories')),

                Tables\Columns\BadgeColumn::make('payment_types.name')
                    ->label(__('fields.filter.paymentType')),

                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('fields.card.created_at'))
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('fields.card.updated_at'))
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),

            ])

            ->bulkActions([
                ChangeLeadPriceAction::make('changeLeadPrice'),
                ChangeStatusAction::make('changeStatus')
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCards::route('/'),
            'create' => Pages\CreateCard::route('/create'),
            'edit' => Pages\EditCard::route('/{record}/edit'),
        ];
    }
}
