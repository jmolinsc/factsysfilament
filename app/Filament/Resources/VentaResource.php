<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VentaResource\Pages;
use App\Filament\Resources\VentaResource\RelationManagers;
use App\Filament\Resources\VentaResource\RelationManagers\VentadsRelationManager;
use App\Models\Venta;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action as ActionsAction;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Artisan;

class VentaResource extends Resource
{
    protected static ?string $model = Venta::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Comercial';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('mov')
                    ->options([
                        'Factura' => 'Factura',
                        'Credito FIscal' => 'Credito FIscal',
                        'Ticket' => 'Ticket',
                    ])->preload()->searchable(),
                Forms\Components\TextInput::make('movid')
                    ->maxLength(50)->disabled(),
                Forms\Components\DatePicker::make('fechaemision')->format('d/m/Y'),
                Forms\Components\Select::make('clienteid')
                    ->relationship(
                        name: 'cte',
                        titleAttribute: 'codigo'
                    )->preload()->searchable(),
                Forms\Components\TextInput::make('sucursal')
                    ->maxLength(50),
                Forms\Components\TextInput::make('referencia')
                    ->maxLength(50),
                Forms\Components\TextInput::make('concepto')
                    ->maxLength(50),
                Forms\Components\TextInput::make('descuentoglobal')
                    ->maxLength(50),
                Forms\Components\TextInput::make('condicion')
                    ->maxLength(50),
                Forms\Components\TextInput::make('comentarios')
                    ->maxLength(50),
                Forms\Components\Select::make('id_alm')
                    ->relationship(
                        name: 'alm',
                        titleAttribute: 'nombre'
                    )->preload()->searchable(),
                Forms\Components\Actions::make([
                    Forms\Components\Actions\Action::make('Afectar')
                        ->action(function (Forms\Get $get, Forms\Set $set) {
                            $set('excerpt', str($get('content'))->words(45, end: ''));
                        })
                ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('mov')
                    ->searchable(),
                Tables\Columns\TextColumn::make('movid')
                    ->searchable(),
                Tables\Columns\TextColumn::make('fechaemision')
                    ->searchable(),
                Tables\Columns\TextColumn::make('cliente')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sucursal')
                    ->searchable(),
                Tables\Columns\TextColumn::make('referencia')
                    ->searchable(),
                Tables\Columns\TextColumn::make('concepto')
                    ->searchable(),
                Tables\Columns\TextColumn::make('descuentoglobal')
                    ->searchable(),
                Tables\Columns\TextColumn::make('condicion')
                    ->searchable(),
                Tables\Columns\TextColumn::make('comentarios')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('id_alm')
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
            VentadsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVentas::route('/'),
            'create' => Pages\CreateVenta::route('/create'),
            'edit' => Pages\EditVenta::route('/{record}/edit'),
        ];
    }
}
