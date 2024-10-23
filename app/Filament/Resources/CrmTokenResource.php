<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CrmTokenResource\Pages;
use App\Filament\Resources\CrmTokenResource\RelationManagers;
use App\Models\CrmToken;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CrmTokenResource extends Resource
{
    protected static ?string $model = CrmToken::class;

    protected static ?string $navigationIcon = 'heroicon-o-hand-raised';

    protected static ?string $modelLabel = "CRM токен";

    protected static ?string $pluralModelLabel = 'CRM токены';

    protected static ?string $navigationGroup = 'Настройки';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('fields.crm.name'))
                    ->maxLength(255),
                Forms\Components\Textarea::make('token')
                    ->label(__('fields.crm.token'))
                    ->maxLength(64)
                    ->helperText('Токен должен содержать не больше 64 символов')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('fields.crm.name'))
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListCrmTokens::route('/'),
            'create' => Pages\CreateCrmToken::route('/create'),
            'edit' => Pages\EditCrmToken::route('/{record}/edit'),
        ];
    }
}
