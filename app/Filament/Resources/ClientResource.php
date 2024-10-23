<?php

namespace App\Filament\Resources;

use App\Filament\Actions\Client\ChangeStatusAction;
use App\Filament\Resources\ClientResource\Pages;
use App\Filament\Resources\ClientResource\RelationManagers;
use App\Models\Client\Client;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static ?string $modelLabel = "Клиент";

    protected static ?string $pluralModelLabel = 'Клиенты';

    protected static ?string $navigationGroup = 'Телеграм';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('telegram_id')
                    ->label(__('fields.client.telegram_id'))
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('first_name')
                    ->label(__('fields.client.first_name'))
                    ->maxLength(255)
                    ->default(null),

                Forms\Components\TextInput::make('last_name')
                    ->label(__('fields.client.last_name'))
                    ->maxLength(255)
                    ->default(null),

                Forms\Components\TextInput::make('username')
                    ->label(__('fields.client.username'))
                    ->maxLength(255)
                    ->default(null),

                Forms\Components\TextInput::make('language_code')
                    ->label(__('fields.client.language_code'))
                    ->maxLength(255)
                    ->default(null),

                Forms\Components\Toggle::make('allows_write_to_pm')
                    ->label(__('fields.client.allows_write_to_pm'))
                    ->required(),

                Forms\Components\Select::make('type')
                    ->label(__('fields.client.type'))
                    ->relationship('client_type', 'name')
                    ->default(null),

                Forms\Components\Select::make('status_id')
                    ->label(__('fields.client.status_id'))
                    ->relationship('status', 'name')
                    ->default(null),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('telegram_id')
                    ->label(__('fields.client.telegram_id'))
                    ->searchable(),

                Tables\Columns\TextColumn::make('first_name')
                    ->label(__('fields.client.first_name'))
                    ->searchable(),

                Tables\Columns\TextColumn::make('last_name')
                    ->label(__('fields.client.last_name'))
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),

                Tables\Columns\TextColumn::make('username')
                    ->label(__('fields.client.username'))
                    ->searchable(),

                Tables\Columns\TextColumn::make('language_code')
                    ->label(__('fields.client.language_code')),

                Tables\Columns\TextColumn::make('client_type.name')
                    ->label(__('fields.client.type'))
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('status.name')
                    ->label(__('fields.client.status_id')),

                Tables\Columns\TextColumn::make('balance')
                    ->label(__('fields.client.balance'))
                    ->numeric(),

                Tables\Columns\IconColumn::make('allows_write_to_pm')
                    ->label(__('fields.client.allows_write_to_pm'))
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('fields.client.created_at'))
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('fields.client.updated_at'))
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                ChangeStatusAction::make('changeStatus')
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/create'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
        ];
    }
}
