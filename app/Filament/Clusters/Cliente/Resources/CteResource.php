<?php

namespace App\Filament\Clusters\Cliente\Resources;

use App\Filament\Clusters\Cliente;
use App\Filament\Clusters\Cliente\Resources\CteResource\Pages;
use App\Filament\Clusters\Cliente\Resources\CteResource\RelationManagers;
use App\Models\Cte;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CteResource extends Resource
{
    protected static ?string $model = Cte::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $cluster = Cliente::class;

    protected static ?string $modelLabel = 'Clientes';

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('codigo')
                    ->required()
                    ->maxLength(191),
                Forms\Components\TextInput::make('nombre')
                    ->required()
                    ->maxLength(191),
                Forms\Components\TextInput::make('telefono')
                    ->tel()
                    ->required()
                    ->maxLength(30),
                Forms\Components\TextInput::make('direccion')
                    ->required()
                    ->maxLength(191),
                Forms\Components\TextInput::make('dui')
                    ->required()
                    ->maxLength(191),
                Forms\Components\TextInput::make('nit')
                    ->required()
                    ->maxLength(191),
                Forms\Components\TextInput::make('nrc')
                    ->required()
                    ->maxLength(191),
                Forms\Components\TextInput::make('tipo')
                    ->required()
                    ->maxLength(191),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(191),
                Forms\Components\Select::make('id_ctegrupo')
                    ->relationship(
                        name: 'ctegrupo',
                        titleAttribute: 'nombre'
                    )->preload()->searchable(),
                Forms\Components\Select::make('id_ctefamilia')
                    ->relationship(
                        name: 'ctefamilia',
                        titleAttribute: 'nombre'
                    )->preload()->searchable(),

                Forms\Components\Select::make('id_pais')
                    ->relationship(
                        name: 'pais',
                        titleAttribute: 'nombre'
                    )->preload()->searchable(),

                Forms\Components\Select::make('id_departamento')
                    ->relationship(
                        name: 'departamento',
                        titleAttribute: 'nombre'
                    )->preload()->searchable(),
                Forms\Components\Select::make('agente.nombre')
                    ->relationship(
                        name: 'agente',
                        titleAttribute: 'nombre'
                    )->preload()->searchable(),
                Forms\Components\Select::make('id_ctecategoria')
                    ->relationship(
                        name: 'ctecategoria',
                        titleAttribute: 'nombre'
                    )->preload()->searchable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('codigo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('telefono')
                    ->searchable(),
                Tables\Columns\TextColumn::make('direccion')
                    ->searchable(),
                Tables\Columns\TextColumn::make('dui')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nit')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nrc')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tipo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('ctegrupo.nombre')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('ctefamilia.nombre')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('pais.nombre')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('departamento.nombre')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('agente.nombre')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('ctecategoria.nombre')
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
            'index' => Pages\ListCtes::route('/'),
            'create' => Pages\CreateCte::route('/create'),
            'edit' => Pages\EditCte::route('/{record}/edit'),
        ];
    }
}
