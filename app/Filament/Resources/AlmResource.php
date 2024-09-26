<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AlmResource\Pages;
use App\Models\Alm;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AlmResource extends Resource
{
    protected static ?string $model = Alm::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Cuentas';

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('codigo')
                    ->required()
                    ->maxLength(191),
                Forms\Components\TextInput::make('tipo')
                    ->maxLength(191),
                Forms\Components\TextInput::make('nombre')
                    ->maxLength(191),
                Forms\Components\TextInput::make('direccion')
                    ->maxLength(191),
                Forms\Components\TextInput::make('sucursal')
                    ->maxLength(191),
                Forms\Components\TextInput::make('encargado')
                    ->maxLength(191),
                Forms\Components\TextInput::make('cuentacontable')
                    ->maxLength(191),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('codigo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tipo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('direccion')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sucursal')
                    ->searchable(),
                Tables\Columns\TextColumn::make('encargado')
                    ->searchable(),
                Tables\Columns\TextColumn::make('cuentacontable')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAlms::route('/'),
            'create' => Pages\CreateAlm::route('/create'),
            'edit' => Pages\EditAlm::route('/{record}/edit'),
        ];
    }
}
