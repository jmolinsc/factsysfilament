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
                                        Group::make()
                                            ->relationship('cte')
                                            ->schema([
                                                TextInput::make('nombre')
                                                    ->label('Nombre')

                                            ])->columnSpan(3),
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
                        ->relationship('ventads')->label('Producto')
                        ->schema([
                            Select::make('productoid')
                                ->relationship(
                                    name: 'producto',
                                    titleAttribute: 'producto'
                                )->preload()->searchable()->required()->reactive()
                                ->disableOptionsWhenSelectedInSiblingRepeaterItems()->columnSpan(4)
                                ->afterStateUpdated(function ($state, Get $get, Set $set) {
                                    //$set('producto.descripcion', '');
                                    if ($get('productoid')) {
                                        $producto = Producto::find($get('productoid'));
                                        $set('precio', $producto['precio_venta']);
                                        $set('importe', $producto['precio_venta']);
                                        $set('descripcion', $producto['descripcion']);
                                    }
                                }),
                            // TextInput::make('producto.descripcion')->disabled()->columnSpan(4),
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
                                ->reactive()
                                ->live()
                                ->afterStateUpdated(
                                    fn($state, Set $set, Get $get) => $set('importe',   $set('importe', $state * $get('precio')))
                                ),
                            TextInput::make('unidad')->columnSpan(2),
                            TextInput::make('precio')->columnSpan(3)
                                ->live()
                                ->afterStateUpdated(
                                    fn($state, Set $set, Get $get) => $set('importe', $state * $get('cantidad'))

                                )
                                ->numeric()->prefix('$'),
                            TextInput::make('importe')->columnSpan(3)
                                ->numeric()
                                ->readOnly()
                                ->prefix('$')
                                ->live(true)
                                ->afterStateUpdated(
                                    fn($state, Set $set, Get $get) => $set('importe', $state * $get('precio'))
                                ),
                            TextInput::make('iva')->columnSpan(2)
                                ->suffix('%')
                                ->numeric(),
                            TextInput::make('ivaimp')->columnSpan(3)
                                ->numeric(),
                            Hidden::make('total')->default(0)
                        ])
                        // Repeatable field is live so that it will trigger the state update on each change
                        ->live()
                        ->reactive()
                        // After adding a new row, we need to update the totals
                        ->afterStateUpdated(function (Get $get, Set $set) {
                            self::updateTotals($get, $set);
                        })->columns(24),
                    Group::make()
                        ->columns(1)
                        ->maxWidth('1/2')
                        ->schema([
                            Forms\Components\TextInput::make('subtotal')->columnSpan(4)
                                ->numeric()
                                // Read-only, because it's calculated
                                ->readOnly()
                                ->prefix('$'),

                            Forms\Components\TextInput::make('impuestos')->columnSpan(4)
                                ->prefix('$')
                                ->default(20)
                                // Live field, as we need to re-calculate the total on each change
                                ->live(true)
                                // This enables us to display the subtotal on the edit page load
                                ->afterStateUpdated(function (Get $get, Set $set) {
                                    self::updateTotals($get, $set);
                                }),
                            Forms\Components\TextInput::make('total')->columnSpan(4)
                                ->numeric()
                                // Read-only, because it's calculated
                                ->readOnly()
                                ->prefix('$')
                        ])->columns(24)
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

    // This function updates totals based on the selected products and quantities
    public static function updateTotals(Get $get, Set $set)
    {
        // Retrieve all selected products and remove empty rows
        $selectedProducts = collect($get('productos'))->filter(fn($item) => !empty($item['productoid']) && !empty($item['cantidad']));
        // Retrieve prices for all selected products
        //$prices = Producto::find($selectedProducts->pluck('productoid'))->pluck('precio_venta', 'id');
        $prices = $selectedProducts->pluck('precio', 'id');
        // Calculate subtotal based on the selected products and quantities
        $subtotal = $selectedProducts->reduce(function ($subtotal, $product) use ($prices) {
            return $subtotal + ($prices[$product['id']] * $product['cantidad']);
        }, 0);

        // Update the state with the new values
        $set('subtotal', number_format($subtotal, 2, '.', ''));
        $set('total', number_format($subtotal + ($subtotal * ($get('iva') / 100)), 2, '.', ''));
    }
}
