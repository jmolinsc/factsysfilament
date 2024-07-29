<?php

namespace App\Filament\Resources\VentaResource\RelationManagers;

use App\Models\Producto;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;

class VentadsRelationManager extends RelationManager
{
    protected static string $relationship = 'ventads';

    public function form(Form $form): Form
    {
        return $form
            ->schema([

                Select::make('productoid')
                    ->relationship(
                        name: 'producto',
                        titleAttribute: 'producto'
                    )->preload()->searchable()->live()
                    ->afterStateUpdated(function (Get $get, Set $set) {
                        $set('precio', '');
                        $set('foto', '');
                        $set('producto.descripcion', '');
                        $set('cantidad', '');
                        if ($get('productoid')) {
                            $producto = Producto::find($get('productoid'));
                            $set('precio', $producto['precio_venta']);
                            $set('foto', $producto['foto']);
                            $set('producto.descripcion', $producto['descripcion']);
                        }
                    }),
                Fieldset::make('Producto')
                    ->relationship('producto')
                    ->schema([
                        TextInput::make('descripcion')->disabled(),

                    ]),
                Forms\Components\TextInput::make('cantidad')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('precio')
                    ->required()->readOnly(true)
                    ->maxLength(255),

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('producto')
            ->recordTitleAttribute('Codigo')
            ->columns([
                Tables\Columns\TextColumn::make('producto.producto'),
                Tables\Columns\TextColumn::make('producto.descripcion'),

                Tables\Columns\TextColumn::make('cantidad'),
                Tables\Columns\TextColumn::make('precio'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
