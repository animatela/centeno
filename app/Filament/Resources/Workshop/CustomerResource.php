<?php

namespace App\Filament\Resources\Workshop;

use App\Filament\Resources\Workshop\CustomerResource\Pages;
use App\Filament\Resources\Workshop\CustomerResource\RelationManagers;
use App\Models\Workshop\Customer;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CustomerResource extends Resource
{
    protected static ?string $label = 'Clientes';

    protected static ?string $model = Customer::class;

    protected static ?string $slug = 'workshop/customers';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationGroup = 'Workshop';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->maxValue(50)
                            ->required(),

                        Forms\Components\TextInput::make('email')
                            ->required()
                            ->email()
                            ->unique(ignoreRecord: true),

                        Forms\Components\Select::make('gender')
                            ->options([
                                'male' => 'Hombre',
                                'female' => 'Mujer',
                            ])
                            ->required(),

                        Forms\Components\TextInput::make('phone')
                            ->maxValue(50),

                        Forms\Components\DatePicker::make('birthday')
                            ->maxDate('today'),

                        Forms\Components\Select::make('document_type')
                            ->options([
                                'dni' => 'DNI',
                                'ce' => 'Carnet de Extranjería',
                                'ruc' => 'Número de RUC',
                            ]),
                        Forms\Components\TextInput::make('document_number')
                            ->maxValue(50),
                    ])
                    ->columns(2)
                    ->columnSpan(['lg' => fn (?Customer $record) => $record === null ? 3 : 2]),

                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Placeholder::make('created_at')
                            ->label('Created at')
                            ->content(fn (Customer $record): ?string => $record->created_at?->diffForHumans()),

                        Forms\Components\Placeholder::make('updated_at')
                            ->label('Last modified at')
                            ->content(fn (Customer $record): ?string => $record->updated_at?->diffForHumans()),
                    ])
                    ->columnSpan(['lg' => 1])
                    ->hidden(fn (?Customer $record) => $record === null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('email'),
                //Tables\Columns\TextColumn::make('photo'),
                Tables\Columns\TextColumn::make('gender'),
                Tables\Columns\TextColumn::make('phone'),
                //Tables\Columns\TextColumn::make('birthday')->date(),
                //Tables\Columns\TextColumn::make('document_type'),
                //Tables\Columns\TextColumn::make('document_number'),
                //Tables\Columns\TextColumn::make('created_at')->date(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->date(),
                //Tables\Columns\TextColumn::make('deleted_at')->date(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make(),
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DetachAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DetachBulkAction::make(),
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return
            parent::getEloquentQuery()
                ->with('addresses')
                ->withoutGlobalScope(SoftDeletingScope::class);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\AddressesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'email'];
    }
}
