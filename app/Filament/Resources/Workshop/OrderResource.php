<?php

namespace App\Filament\Resources\Workshop;

use App\Filament\Resources\Workshop\OrderResource\Pages;
use App\Filament\Resources\Workshop\OrderResource\RelationManagers;
use App\Filament\Resources\Workshop;
use App\Models\Order;
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
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
}
