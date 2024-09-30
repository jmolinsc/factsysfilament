<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VentaResource\Pages;
use App\Filament\Resources\VentaResource\RelationManagers;
use App\Filament\Resources\VentaResource\RelationManagers\VentadsRelationManager;
use App\Models\Cte;
use App\Models\Producto;
use App\Models\Venta;
use Closure;

use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action as ActionsAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Number;

class VentaResource extends Resource
{
    protected static ?string $model = Venta::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Comercial';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Tabs')
                    ->tabs([
                        Tab::make('Datos Generales')
                            ->schema([
                                Grid::make(4)
                                    ->schema([
                                        Forms\Components\Select::make('mov')
                                            ->options([
                                                'Factura' => 'Factura',
                                                'Credito FIscal' => 'Credito FIscal',
                                                'Ticket' => 'Ticket',
                                            ])->preload()->searchable()->columnSpan(1),
                                        Forms\Components\TextInput::make('movid')->columnSpan(1)
                                            ->maxLength(50)->disabled(),
                                        // Forms\Components\DatePicker::make('fechaemision')->format('d/m/Y'),
                                        DatePicker::make('fechaemision')
                                            ->native(false)
                                            ->displayFormat('d/m/Y')->columnSpan(1),
                                        Forms\Components\Select::make('clienteid')
                                            ->relationship(
                                                name: 'cte',
                                                titleAttribute: 'codigo'
                                            )->preload()
                                            ->searchable()
                                            ->live()
                                            ->afterStateUpdated(function (Get $get, Set $set) {

                                                if ($get('clienteid')) {
                                                    $cte = Cte::find($get('clienteid'));
                                                    $set('nombre', $cte['nombre']);
                                                }
                                            })
                                            ->columnSpan(1),
                                        TextInput::make('nombre')
                                            ->reactive()
                                            ->afterStateUpdated(function (Closure $set, $state) {
                                                dd($state);
                                                if ($state('clienteid')) {
                                                    $cte = Cte::find($state('clienteid'));
                                                    $set('nombre', $cte['nombre']);
                                                }
                                            }),
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

                                    ])
                            ])->columns(12)


                    ])->activeTab(1)->columnSpan(4),
                Section::make('Detalle Productos')->schema([
                    Repeater::make('productos')
                        ->relationship('ventads')
                        ->schema([
                            Select::make('productoid')
                                ->relationship(
                                    name: 'producto',
                                    titleAttribute: 'producto'
                                )->preload()->searchable()->required()->reactive()
                                ->disableOptionsWhenSelectedInSiblingRepeaterItems()->columnSpan(2)
                                ->afterStateUpdated(function ($state, Get $get, Set $set) {

                                    //$set('producto.descripcion', '');
                                    if ($get('productoid')) {
                                        $producto = Producto::find($get('productoid'));
                                        $set('precio', $producto['precio_venta']);
                                        $set('importe', $producto['precio_venta']);
                                        $set('descripcion', $producto['descripcion']);
                                    }
                                }),
                            TextInput::make('descripcion')->disabled()->columnSpan(4),
                            TextInput::make('cantidad')->columnSpan(2)
                                ->numeric()
                                ->required()
                                ->default(1)
                                ->minValue(1)
                                ->reactive()
                                ->afterStateUpdated(
                                    fn($state, Set $set, Get $get) => $set('importe', $state * $get('precio'))
                                ),
                            TextInput::make('precio')->columnSpan(2)
                                ->numeric()
                                ->required()
                                ->disabled(),
                            TextInput::make('importe')->columnSpan(2)
                                ->numeric()
                                ->required()
                                ->disabled(),
                        ])->columns(12),
                    Placeholder::make('Total')
                        ->label('Importe Total')
                        ->content(function (Get $get, Set $set) {
                            $total = 0;
                            if (!$repeaters = $get('productos')) {
                                return $total;
                            }
                            foreach ($repeaters as $key => $repeater) {
                                $total += $get("productos.{$key}.importe");
                            }
                            return Number::currency($total, 'USD');
                        }),
                    Hidden::make('total')->default(0)
                ])->columnSpan(4),
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
                Tables\Columns\TextColumn::make('cte.codigo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('cte.nombre')
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
            // VentadsRelationManager::class
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
