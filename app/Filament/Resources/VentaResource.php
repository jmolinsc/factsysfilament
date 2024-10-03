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
use Filament\Forms\Components\Group;
use Icetalker\FilamentTableRepeater\Forms\Components\TableRepeater;

class VentaResource extends Resource
{
    protected static ?string $model = Venta::class;
    public $importe;
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
                                Section::make()
                                    ->schema([

                                        Forms\Components\Select::make('mov')
                                            ->options([
                                                'Factura' => 'Factura',
                                                'Credito FIscal' => 'Credito FIscal',
                                                'Ticket' => 'Ticket',
                                            ])->preload()->searchable()->columnSpan(8)->required(),
                                        Forms\Components\TextInput::make('movid')->columnSpan(8)
                                            ->readOnly(),
                                        //Forms\Components\DatePicker::make('fechaemision')->format('d/m/Y'),
                                        DatePicker::make('fechaemision')
                                            ->native(false)
                                            ->required()
                                            ->displayFormat('d/m/Y')->columnSpan(8),


                                        Forms\Components\Select::make('clienteid')->label('Cliente')
                                            ->relationship(
                                                name: 'cte',
                                                titleAttribute: 'codigo'
                                            )->preload()
                                            ->searchable()
                                            ->live()
                                            ->required()
                                            ->afterStateUpdated(function (Get $get, Set $set) {

                                                if ($get('clienteid')) {
                                                    $cte = Cte::find($get('clienteid'));
                                                    $set('nombre', $cte['nombre']);
                                                }
                                            })
                                            ->columnSpan(8),
                                        Group::make()
                                            ->relationship('cte')
                                            ->schema([
                                                TextInput::make('nombre')
                                                    ->label('Nombre')

                                            ])->columnSpan(16),


                                        Forms\Components\Select::make('sucursal')
                                            ->options([
                                                '0' => 'San Salvador',
                                                '1' => 'San Miguel',

                                            ])->preload()->searchable()->columnSpan(6),
                                            Forms\Components\Select::make('condicion')
                                            ->options([
                                                'Contado' => 'Contado',
                                                'Credito' => 'Credito',

                                            ])->preload()->searchable()->columnSpan(6),

                                        Forms\Components\Select::make('concepto')
                                            ->options([
                                                'Estudiante' => 'Estudiante',
                                                'Negocio Formal' => 'Negocio Formal',

                                            ])->preload()->searchable()->columnSpan(6),

                                        Forms\Components\Select::make('descuentoglobal')
                                            ->options([
                                                '5' => '5 %',
                                                '10' => '10 %',
                                                '15' => '15 %',
                                                '20' => '20 %',
                                            ])->preload()->searchable()->columnSpan(6),

                                            Forms\Components\TextInput::make('referencia')
                                            ->maxLength(50)->columnSpan(12),
                                        Forms\Components\TextInput::make('comentarios')
                                            ->maxLength(50)->columnSpan(6),
                                        Forms\Components\Select::make('id_alm')->label('Almacen')->columnSpan(6)
                                            ->relationship(
                                                name: 'alm',
                                                titleAttribute: 'codigo'
                                            )->preload()->searchable(),

                                    ])->columns(24)
                            ])->columnSpan('full')


                    ])->activeTab(1)->columnSpan('full'),
                Section::make('Detalle Productos')->schema([
                    Repeater::make('productos')
                        ->relationship('ventads')->label('Producto')
                        ->schema([
                            Select::make('productoid')
                                ->relationship(
                                    name: 'producto',
                                    titleAttribute: 'producto'
                                )->preload()->searchable()->required()->reactive()
                                ->distinct()
                                ->disableOptionsWhenSelectedInSiblingRepeaterItems()->columnSpan(4)
                                //->afterStateUpdated(fn($state, Get $get, Set $set) => $set('precio', Producto::find($state)->preciolista ?? 0)),
                                ->afterStateUpdated(function ($state, Get $get, Set $set) {
                                    if ($get('productoid')) {
                                        $producto = Producto::find($get('productoid'));
                                        $set('precio', $producto['preciolista']);
                                        $set('importe', $producto['preciolista']);
                                        $set('producto.descripcion', $producto['descripcion']);
                                        $set('producto.iva', $producto['iva']);
                                        $set('ivaimp', (($producto['preciolista'] *  1) * ($producto['iva'] / 100)), '');
                                    }
                                }),
                            Group::make()
                                ->relationship('producto')
                                ->schema([
                                    TextInput::make('descripcion')
                                        ->label('Descripcion')
                                ])->columnSpan(5),
                            TextInput::make('cantidad')->columnSpan(2)
                                ->numeric()
                                ->required()
                                ->default(1)
                                ->minValue(1)
                                ->dehydrated()
                                ->reactive()
                                ->live()
                                ->afterStateUpdated(
                                    function ($state, Set $set, Get $get) {
                                        $set('importe',   $state * $get('precio'));
                                        $set('ivaimp', $get('importe') * ($get('producto.iva') / 100));
                                    }
                                ),
                            //TextInput::make('unidad')->columnSpan(2),
                            Select::make('unidad')
                                ->options([
                                    'und' => 'und',
                                    'lt' => 'lt',
                                    'lb' => 'lb',
                                ])->preload()->searchable()->columnSpan(3),
                            TextInput::make('precio')->columnSpan(2)
                                ->live()
                                ->label('Precio $')
                                ->dehydrated()
                                ->afterStateUpdated(
                                    function ($state, Set $set, Get $get) {
                                        $set('importe', $state * $get('cantidad'));
                                        $set('ivaimp', $get('importe') * ($get('producto.iva') / 100));
                                    }
                                )
                                ->numeric(),
                            TextInput::make('importe')->columnSpan(3)
                                ->readOnly()
                                ->label('Importe $')
                                ->dehydrated(),
                            Group::make()
                                ->relationship('producto')
                                ->schema([
                                    TextInput::make('iva')
                                        ->label('IVA %')->readOnly()
                                ])->dehydrated()->columnSpan(2),
                            TextInput::make('ivaimp')->label('Iva Imp.')
                                ->columnSpan(3)->readOnly()->dehydrated(),

                            //Hidden::make('total')->default(0)
                        ])->columns(24),

                    Group::make()
                        ->schema([
                            PlaceHolder::make('importetotal')->columnSpan(2)
                                ->label('Sub Total')
                                ->content(function (Get $get, Set $set) {
                                    $total = 0;
                                    if (!$repeaters = $get('productos')) {
                                        return $total;
                                    }
                                    foreach ($repeaters as $key => $repeater) {

                                        $total += (float) $get("productos.{$key}.importe");
                                    }

                                    //dump($get('importetotal'));
                                    return Number::currency($total, 'USD');
                                }),
                            PlaceHolder::make('impuestos')->columnSpan(2)
                                ->label('Impuestos')
                                ->content(function (Get $get, Set $set) {
                                    $total = 0;
                                    if (!$repeaters = $get('productos')) {
                                        return $total;
                                    }
                                    foreach ($repeaters as $key => $repeater) {

                                        $total += (float) $get("productos.{$key}.ivaimp");
                                    }

                                    //dump($get('importetotal'));
                                    return Number::currency($total, 'USD');
                                })->columns(2),
                            PlaceHolder::make('total')->columnSpan(2)
                                ->label('Total')
                                ->content(function (Get $get, Set $set) {
                                    $total = 0;
                                    $ivaimp = 0;
                                    if (!$repeaters = $get('productos')) {
                                        return $total;
                                    }
                                    foreach ($repeaters as $key => $repeater) {

                                        $total += (float) $get("productos.{$key}.importe");
                                        $ivaimp += (float) $get("productos.{$key}.ivaimp");
                                    }

                                    //dump($get('importetotal'));
                                    return Number::currency($total + $ivaimp, 'USD');
                                })->columns(2),
                            Hidden::make('importetotal')->default(0),
                            Hidden::make('impuestos')->default(0),
                            Hidden::make('total')->default(0)

                        ])->columns(24)



                ])->columnSpan('full'),

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

    // This function updates totals based on the selected products and quantities
    public static function sumColumn(Get $get, Set $set)
    {

        $importe = 0;
        $ivaimp = 0;
        $total = 0;
        if (!$repeaters = $get('productos')) {
            return $importe;
        }
        foreach ($repeaters as $key => $repeater) {
            $importe += $get("productos.{$key}.importe");
            $ivaimp += $get("productos.{$key}.ivaimp");
            $total = $importe + $ivaimp;
        }
        //$importe = Number::currency($importe, 'USD');
        return [$importe, $ivaimp, $total];
    }
}
