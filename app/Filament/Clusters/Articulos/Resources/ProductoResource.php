<?php

namespace App\Filament\Clusters\Articulos\Resources;

use App\Filament\Clusters\Articulos;
use App\Filament\Clusters\Articulos\Resources\ProductoResource\Pages;
use App\Filament\Clusters\Articulos\Resources\ProductoResource\RelationManagers;
use App\Models\Producto;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Form;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductoResource extends Resource
{
    protected static ?string $model = Producto::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $cluster = Articulos::class;

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    protected static ?int $navigationSort = 1;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\TextInput::make('producto')
                    ->required()
                    ->maxLength(191),
                Forms\Components\Select::make('tipo')
                    ->options([
                        'Normal' => 'Normal',
                        'Serie' => 'Serie',
                        'Activo Fijo' => 'Activo Fijo',
                    ])->preload()->searchable(),
                Forms\Components\TextInput::make('descripcion')
                    ->required()
                    ->maxLength(50),
                Forms\Components\Select::make('unidad')
                    ->options([
                        'und' => 'und',
                        'lt' => 'lt',
                        'lb' => 'lb',
                    ])->preload()->searchable(),
                Forms\Components\TextInput::make('peso')
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('precio_compra')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('precio_venta')
                    ->required()
                    ->numeric(),

                Forms\Components\Select::make('id_categoria')
                    ->relationship(
                        name: 'categoria',
                        titleAttribute: 'nombre'
                    )->preload()->searchable(),
                Forms\Components\Select::make('id_fabricante')
                    ->relationship(
                        name: 'fabricante',
                        titleAttribute: 'nombre'
                    )->preload()->searchable(),
                Forms\Components\Select::make('id_familia')
                    ->relationship(
                        name: 'familia',
                        titleAttribute: 'nombre'
                    )->preload()->searchable(),
                Forms\Components\Select::make('id_linea')
                    ->relationship(
                        name: 'linea',
                        titleAttribute: 'nombre'
                    )->preload()->searchable(),
                Card::make('')
                    ->schema([
                        Forms\Components\FileUpload::make('foto')->directory('products')
                            ->preserveFilenames()
                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('producto')
                    ->searchable(),
                Tables\Columns\TextColumn::make('descripcion')
                    ->searchable(),

                Tables\Columns\TextColumn::make('precio_compra')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('precio_venta')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('foto')->width(25)->height(25)->circular()
                    ->searchable(),
                Tables\Columns\TextColumn::make('categoria.nombre')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('fabricante.nombre')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('familia.nombre')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('linea.nombre')
                    ->numeric()
                    ->sortable(),
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
            'index' => Pages\ListProductos::route('/'),
            'create' => Pages\CreateProducto::route('/create'),
            'edit' => Pages\EditProducto::route('/{record}/edit'),
        ];
    }
}
