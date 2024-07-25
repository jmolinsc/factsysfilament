<?php

namespace App\Filament\Resources\VentaResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VentadsRelationManager extends RelationManager
{
    protected static string $relationship = 'ventads';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('producto')
                    ->required()
                    ->maxLength(255),
                    Forms\Components\TextInput::make('codigo')
                    ->required()
                    ->maxLength(255),
                    Forms\Components\TextInput::make('cantidad')
                    ->required()
                    ->maxLength(255),
                    Forms\Components\TextInput::make('precio')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('producto')
            ->recordTitleAttribute('Codigo')
            ->columns([
                Tables\Columns\TextColumn::make('producto'),
                Tables\Columns\TextColumn::make('codigo'),
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
