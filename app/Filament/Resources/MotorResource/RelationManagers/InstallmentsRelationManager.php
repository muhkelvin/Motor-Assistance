<?php

namespace App\Filament\Resources\MotorResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class InstallmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'installments';
    protected static ?string $title = 'Credit Simulations';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('down_payment')
                    ->required()
                    ->numeric()
                    ->prefix('Rp')
                    ->minValue(0),

                Forms\Components\TextInput::make('tenor_months')
                    ->required()
                    ->integer()
                    ->minValue(1)
                    ->maxValue(60)
                    ->label('Tenor (months)'),

                Forms\Components\TextInput::make('installment_amount')
                    ->required()
                    ->numeric()
                    ->prefix('Rp')
                    ->label('Monthly Installment'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('down_payment')
                    ->money('IDR')
                    ->sortable(),

                Tables\Columns\TextColumn::make('tenor_months')
                    ->label('Tenor')
                    ->suffix(' months')
                    ->sortable(),

                Tables\Columns\TextColumn::make('installment_amount')
                    ->money('IDR')
                    ->label('Monthly Installment')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->filters([])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Add New Simulation'),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
