<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InquiryResource\Pages;
use App\Filament\Resources\InquiryResource\RelationManagers;
use App\Models\Inquiry;
use App\Models\Motor;
use App\Models\MotorInstallment;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InquiryResource extends Resource
{
    protected static ?string $model = Inquiry::class;
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';
    protected static ?string $navigationGroup = 'Inquiries Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Customer Information')
                    ->schema([
                        TextInput::make('customer_name')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('phone')
                            ->required()
                            ->tel()
                            ->maxLength(20),

                        TextInput::make('email')
                            ->email()
                            ->maxLength(255),

                        TextInput::make('city')
                            ->maxLength(100),

                        Select::make('preferred_contact_time')
                            ->options([
                                'morning' => 'Morning',
                                'afternoon' => 'Afternoon',
                                'evening' => 'Evening',
                                'anytime' => 'Anytime',
                            ])
                            ->default('anytime'),
                    ])
                    ->columns(2),

                Section::make('Inquiry Details')
                    ->schema([
                        Select::make('motor_id')
                            ->label('Motor')
                            ->options(Motor::all()->pluck('name', 'id'))
                            ->required()
                            ->searchable(),

                        Select::make('credit_simulation_id')
                            ->label('Credit Simulation')
                            ->options(MotorInstallment::all()->pluck('id', 'id'))
                            ->searchable(),

                        Textarea::make('notes')
                            ->rows(3),

                        Select::make('status')
                            ->options([
                                'new' => 'New',
                                'contacted' => 'Contacted',
                                'qualified' => 'Qualified',
                                'closed' => 'Closed',
                            ])
                            ->default('new'),

                        DateTimePicker::make('contacted_at')
                            ->nullable(),

                        Select::make('source')
                            ->options([
                                'website' => 'Website',
                                'social_media' => 'Social Media',
                                'other' => 'Other',
                            ])
                            ->default('website'),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('customer_name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('phone')
                    ->searchable(),

                TextColumn::make('motor.name')
                    ->searchable()
                    ->sortable(),

                BadgeColumn::make('status')
                    ->colors([
                        'primary' => 'new',
                        'warning' => 'contacted',
                        'success' => 'qualified',
                        'danger' => 'closed',
                    ])
                    ->icons([
                        'heroicon-o-plus' => 'new',
                        'heroicon-o-phone' => 'contacted',
                        'heroicon-o-badge-check' => 'qualified',
                        'heroicon-o-x-circle' => 'closed',
                    ]),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'new' => 'New',
                        'contacted' => 'Contacted',
                        'qualified' => 'Qualified',
                        'closed' => 'Closed',
                    ])
                    ->default('new'),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
                Action::make('contacted')
                    ->label('Mark as Contacted')
                    ->icon('heroicon-o-phone')
                    ->action(function (Inquiry $record) {
                        $record->status = 'contacted';
                        $record->contacted_at = now();
                        $record->save();
                    })
                    ->visible(fn (Inquiry $record) => $record->status === 'new'),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
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
            'index' => Pages\ListInquiries::route('/'),
            'create' => Pages\CreateInquiry::route('/create'),
            'edit' => Pages\EditInquiry::route('/{record}/edit'),
        ];
    }
}
