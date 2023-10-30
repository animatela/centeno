<?php

namespace App\Filament\Resources\Workshop;

use App\Enums\OrderStatus;
use App\Filament\Resources\Workshop\OrderResource\Pages;
use App\Filament\Resources\Workshop\OrderResource\RelationManagers;
use App\Filament\Resources\Workshop;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $label = 'Orden de Reparación';

    protected static ?string $pluralModelLabel = 'Órdenes de Reparación';

    protected static ?string $model = Order::class;

    protected static ?string $slug = 'workshop/orders';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationGroup = 'Workshop';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make()
                            ->schema(static::getFormSchema())
                            ->columns(2),

                        Forms\Components\Section::make('Order items')
                            ->schema(static::getFormSchema('items')),
                    ])
                    ->columnSpan(['lg' => fn (?Order $record) => $record === null ? 3 : 2]),

                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Placeholder::make('created_at')
                            ->label('Created at')
                            ->content(fn (Order $record): ?string => $record->created_at?->diffForHumans()),

                        Forms\Components\Placeholder::make('updated_at')
                            ->label('Last modified at')
                            ->content(fn (Order $record): ?string => $record->updated_at?->diffForHumans()),
                    ])
                    ->columnSpan(['lg' => 1])
                    ->hidden(fn (?Order $record) => $record === null),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('customer.name')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('service.name')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('Y-m-d H:i:s', 'America/Lima')
                    ->sortable()
                    ->toggleable()
                    ->alignEnd(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Workshop\OrderResource\Pages\ListOrders::route('/'),
            'create' => Workshop\OrderResource\Pages\CreateOrder::route('/create'),
            'view' => Workshop\OrderResource\Pages\ViewOrder::route('/{record}'),
            'edit' => Workshop\OrderResource\Pages\EditOrder::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getFormSchema(string $section = null): array
    {
        if ($section === 'items') {
            return [];
        }

        return [

            Forms\Components\Hidden::make('user_id')
                ->default(fn () => auth()->id()),

            Forms\Components\Select::make('shop_customer_id')
                ->relationship('customer', 'name')
                ->searchable()
                ->required()
                ->createOptionForm([
                    Forms\Components\TextInput::make('name')
                        ->label('Nombre')
                        ->required(),

                    Forms\Components\TextInput::make('email')
                        ->label('Correo electrónico')
                        ->required()
                        ->email()
                        ->unique(),

                    Forms\Components\TextInput::make('phone')
                        ->label('Teléfono'),

                    Forms\Components\Select::make('gender')
                        ->label('Género')
                        ->placeholder('Seleccione un género')
                        ->options([
                            'male' => 'Hombre',
                            'female' => 'Mujer',
                        ])
                        ->required()
                        ->native(false),
                ])
                ->createOptionAction(function (Forms\Components\Actions\Action $action) {
                    return $action
                        ->modalHeading('Nuevo cliente')
                        ->modalSubmitActionLabel('Crear cliente')
                        ->modalWidth('lg');
                }),

            Forms\Components\Select::make('status')
                ->options(OrderStatus::class)
                ->required()
                ->native(false),
        ];
    }
}
