<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MotorResource\Pages;
use App\Filament\Resources\MotorResource\RelationManagers;
use App\Filament\Resources\MotorResource\RelationManagers\InstallmentsRelationManager;
use App\Models\Category;
use App\Models\Motor;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class MotorResource extends Resource
{
    protected static ?string $model = Motor::class;
    protected static ?string $navigationIcon = 'heroicon-o-truck';
    protected static ?string $navigationGroup = 'Motor Management';
    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('MotorTabs')
                    ->tabs([
                        Tab::make('General Information')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                Section::make('Basic Info')
                                    ->schema([
                                        Forms\Components\TextInput::make('name')
                                            ->required()
                                            ->maxLength(255)
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                                                if ($operation === 'edit') {
                                                    return;
                                                }
                                                $set('slug', Str::slug($state));
                                            }),

                                        Forms\Components\TextInput::make('slug')
                                            ->required()
                                            ->maxLength(255)
                                            ->unique(ignoreRecord: true),

                                        Forms\Components\Select::make('category_id')
                                            ->label('Category')
                                            ->options(Category::all()->pluck('name', 'id'))
                                            ->required()
                                            ->searchable(),
                                    ])
                                    ->columns(2),

                                Section::make('Pricing & Status')
                                    ->schema([
                                        Forms\Components\TextInput::make('price')
                                            ->required()
                                            ->numeric()
                                            ->prefix('Rp'),

                                        Forms\Components\Toggle::make('is_featured'),
                                        Forms\Components\Toggle::make('is_active')
                                            ->default(true),

                                        Forms\Components\TextInput::make('sort_order')
                                            ->numeric()
                                            ->default(0),
                                    ])
                                    ->columns(3),

                                Forms\Components\Textarea::make('description')
                                    ->rows(4)
                                    ->columnSpanFull(),
                            ]),

                        Tab::make('Specifications')
                            ->icon('heroicon-o-cog')
                            ->schema([
                                Section::make('Technical Details')
                                    ->schema([
                                        Forms\Components\TextInput::make('model_year')
                                            ->required()
                                            ->maxLength(4),

                                        Forms\Components\TextInput::make('engine_cc')
                                            ->required()
                                            ->numeric(),

                                        Forms\Components\Select::make('fuel_type')
                                            ->options([
                                                'Gasoline' => 'Gasoline',
                                                'Diesel' => 'Diesel',
                                                'Electric' => 'Electric',
                                            ])
                                            ->default('Gasoline'),

                                        Forms\Components\Select::make('transmission')
                                            ->options([
                                                'Automatic' => 'Automatic',
                                                'Manual' => 'Manual',
                                                'Semi-Automatic' => 'Semi-Automatic',
                                            ])
                                            ->default('Automatic'),

                                        Forms\Components\TextInput::make('fuel_capacity')
                                            ->numeric()
                                            ->step(0.1),
                                    ])
                                    ->columns(3),

                                Section::make('Features')
                                    ->schema([
                                        Forms\Components\TagsInput::make('colors')
                                            ->placeholder('Add color')
                                            ->required(),

                                        Forms\Components\KeyValue::make('specifications')
                                            ->keyLabel('Specification')
                                            ->valueLabel('Value')
                                            ->required(),

                                        Forms\Components\TagsInput::make('features')
                                            ->placeholder('Add feature'),
                                    ]),
                            ]),

                        Tab::make('Media')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                Forms\Components\FileUpload::make('main_image')
                                    ->directory('motors')
                                    ->image()
                                    ->maxSize(2048)
                                    ->imageEditor()
                                    ->columnSpanFull(),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('main_image')
                    ->label('')
                    ->circular()
                    ->size(50),

                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->description(fn (Motor $record) => $record->category->name),

                Tables\Columns\TextColumn::make('price')
                    ->money('IDR')
                    ->sortable()
                    ->alignEnd(),

                Tables\Columns\TextColumn::make('model_year')
                    ->sortable()
                    ->alignCenter(),

                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean()
                    ->alignCenter(),

                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->alignCenter(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->relationship('category', 'name'),

                Tables\Filters\TernaryFilter::make('is_featured'),

                Tables\Filters\TernaryFilter::make('is_active'),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
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
            ]);
    }

    public static function getRelations(): array
    {
        return [
            InstallmentsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMotors::route('/'),
            'create' => Pages\CreateMotor::route('/create'),
            'edit' => Pages\EditMotor::route('/{record}/edit'),
        ];
    }
}
