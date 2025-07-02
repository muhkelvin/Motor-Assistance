<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MotorInstallmentResource\Pages;
use App\Filament\Resources\MotorInstallmentResource\RelationManagers;
use App\Models\Motor;
use App\Models\MotorInstallment;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MotorInstallmentResource extends Resource
{
    protected static ?string $model = MotorInstallment::class;
    protected static ?string $navigationIcon = 'heroicon-o-credit-card';
    protected static ?string $navigationGroup = 'Motor Management';
    protected static ?string $modelLabel = 'Credit Simulation';
    protected static ?string $recordTitleAttribute = 'motor.name';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('motor_id')
                    ->label('Motor')
                    ->options(Motor::query()->where('is_active', true)->pluck('name', 'id'))
                    ->required()
                    ->searchable()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $motor = Motor::find($state);
                        if ($motor) {
                            $set('price', $motor->price);
                        }
                    }),

                Forms\Components\TextInput::make('price')
                    ->prefix('Rp')
                    ->disabled()
                    ->dehydrated()
                    ->label('Motor Price'),

                Forms\Components\TextInput::make('down_payment')
                    ->required()
                    ->numeric()
                    ->prefix('Rp')
                    ->minValue(0)
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (callable $get, callable $set) {
                        $this->calculateInstallment($get, $set);
                    }),

                Forms\Components\TextInput::make('tenor_months')
                    ->required()
                    ->integer()
                    ->minValue(1)
                    ->maxValue(60)
                    ->label('Tenor (months)')
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (callable $get, callable $set) {
                        $this->calculateInstallment($get, $set);
                    }),

                Forms\Components\TextInput::make('installment_amount')
                    ->prefix('Rp')
                    ->readOnly()
                    ->label('Monthly Installment'),
            ]);
    }

    protected static function calculateInstallment(callable $get, callable $set): void
    {
        $price = (float) str_replace(',', '', $get('price') ?? 0);
        $downPayment = (float) str_replace(',', '', $get('down_payment') ?? 0);
        $tenor = (int) $get('tenor_months') ?? 1;

        if ($price > 0 && $tenor > 0 && $downPayment < $price) {
            $installment = ($price - $downPayment) / $tenor;
            $set('installment_amount', number_format($installment, 2));
        } else {
            $set('installment_amount', 0);
        }
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('motor.name')
                    ->searchable()
                    ->sortable()
                    ->description(fn (MotorInstallment $record) => $record->motor->model_year),

                Tables\Columns\TextColumn::make('down_payment')
                    ->money('IDR')
                    ->sortable()
                    ->alignEnd(),

                Tables\Columns\TextColumn::make('tenor_months')
                    ->label('Tenor')
                    ->suffix(' months')
                    ->sortable()
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('installment_amount')
                    ->money('IDR')
                    ->label('Monthly')
                    ->sortable()
                    ->alignEnd(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->alignEnd(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('motor')
                    ->relationship('motor', 'name'),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListMotorInstallments::route('/'),
            'create' => Pages\CreateMotorInstallment::route('/create'),
            'edit' => Pages\EditMotorInstallment::route('/{record}/edit'),
        ];
    }
}
