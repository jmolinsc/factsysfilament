<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VentadResource\Pages;
use App\Filament\Resources\VentadResource\RelationManagers;
use App\Models\Ventad;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VentadResource extends Resource
{
    protected static ?string $model = Ventad::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Comercial';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('codigo')
                    ->maxLength(50),
                Forms\Components\TextInput::make('productoid')
                    ->maxLength(50),
                Forms\Components\TextInput::make('cantidad')
                    ->maxLength(50),
                Forms\Components\TextInput::make('precio')
                    ->maxLength(50),
                Forms\Components\TextInput::make('unidad')
                    ->maxLength(50),
                Forms\Components\TextInput::make('descuentolinea')
                    ->maxLength(50),
                Forms\Components\TextInput::make('importe')
                    ->maxLength(50),
                Forms\Components\TextInput::make('ivaimp')
                    ->maxLength(50),
                Forms\Components\TextInput::make('iva')
                    ->maxLength(50),
                Forms\Components\TextInput::make('idventa')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('codigo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('productoid')
                    ->searchable(),
                Tables\Columns\TextColumn::make('cantidad')
                    ->searchable(),
                Tables\Columns\TextColumn::make('precio')
                    ->searchable(),
                Tables\Columns\TextColumn::make('unidad')
                    ->searchable(),
                Tables\Columns\TextColumn::make('descuentolinea')
                    ->searchable(),
                Tables\Columns\TextColumn::make('importe')
                    ->searchable(),
                Tables\Columns\TextColumn::make('ivaimp')
                    ->searchable(),
                Tables\Columns\TextColumn::make('iva')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('idventa')
                    ->numeric()
                    ->sortable(),
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
            'index' => Pages\ListVentads::route('/'),
            'create' => Pages\CreateVentad::route('/create'),
            'edit' => Pages\EditVentad::route('/{record}/edit'),
        ];
    }
}
