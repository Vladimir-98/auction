<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Forms\Components\Toggle;
use Filament\Tables;
use App\Models\User;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Hash;
use Filament\View\LegacyComponents\Page;
use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Настройки';

    protected static ?string $modelLabel = "Пользователь";

    protected static ?string $pluralModelLabel = 'Пользователи';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(Str::ucfirst(__('fields.user.name')))
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('email')
                    ->label(Str::ucfirst(__('fields.user.email')))
                    ->email()
                    ->required()
                    ->maxLength(255),

                Forms\Components\DateTimePicker::make('email_verified_at')
                    ->label(Str::ucfirst(__('fields.user.email_verified_at'))),

                Forms\Components\TextInput::make('password')
                    ->label(Str::ucfirst(__('fields.user.password')))
                    ->password()
                    ->required()
                    ->visibleOn('create')
                    ->dehydrateStateUsing(fn($state) => Hash::make($state))
                    ->dehydrated(fn($state) => filled($state))
                    ->maxLength(255),

                Forms\Components\Select::make('roles')
                    ->label(Str::ucfirst(__('fields.user.roles')))
                    ->relationship('roles', 'name')
                    ->multiple()
                    ->preload()
                    ->searchable(),

                Forms\Components\Toggle::make('access_filament')
                    ->label('Доступ к админке')
                    ->default(fn(?User $record) => $record ? $record->hasPermissionTo('access_filament') : false)
                    ->dehydrateStateUsing(fn($state) => $state) // сохраняем состояние
                    ->afterStateHydrated(fn(Toggle $component, ?User $record) => $record ? $component->state($record->hasPermissionTo('access_filament')) : $component->state(false))
                    ->saveRelationshipsUsing(function (?User $record, $state) {
                        if ($record) {
                            if ($state) {
                                $record->givePermissionTo('access_filament');
                            } else {
                                $record->revokePermissionTo('access_filament');
                            }
                        }
                    })
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(Str::ucfirst(__('fields.user.name')))
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label(Str::ucfirst(__('fields.user.email')))
                    ->searchable(),
                Tables\Columns\TextColumn::make('email_verified_at')
                    ->label(Str::ucfirst(__('fields.user.email_verified_at')))
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(Str::ucfirst(__('fields.user.created_at')))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(Str::ucfirst(__('fields.user.updated_at')))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

}
