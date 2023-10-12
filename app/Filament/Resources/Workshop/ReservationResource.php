<?php

namespace App\Filament\Resources\Workshop;

use App\Filament\Resources\Workshop\ReservationResource\Pages;
use App\Filament\Resources\Workshop\ReservationResource\RelationManagers;
use App\Models\Workshop\Reservation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Idat\Centeno\Workshop\Enums\ReservationStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class ReservationResource extends Resource
{
    protected static ?string $label = 'Reservas';

    protected static ?string $model = Reservation::class;

    protected static ?string $slug = 'workshop/reservations';

    protected static ?string $recordTitleAttribute = 'number';

    protected static ?string $navigationGroup = 'Workshop';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 0;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('service_id'),
                Forms\Components\TextInput::make('vehicle_id'),
                Forms\Components\TextInput::make('number')
                    ->required(),
                Forms\Components\TextInput::make('currency'),
                Forms\Components\TextInput::make('price'),
                Forms\Components\Select::make('status')
                    ->options([
                        ReservationStatus::NEW->value => 'Nueva',
                        ReservationStatus::STARTED->value => 'Iniciada',
                        ReservationStatus::PROCESSING->value => 'En Proceso',
                        ReservationStatus::COMPLETED->value => 'Completada',
                        ReservationStatus::CANCELLED->value => 'Cancelada',
                    ])
                    ->required(),
                Forms\Components\Textarea::make('notes'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('service.name')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                //Tables\Columns\TextColumn::make('service_id'),
                //Tables\Columns\TextColumn::make('vehicle_id'),
                Tables\Columns\TextColumn::make('vehicle.id')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('currency'),
                Tables\Columns\TextColumn::make('price'),
                Tables\Columns\TextColumn::make('status')
                    ->sortable(),
                //Tables\Columns\TextColumn::make('notes'),
                Tables\Columns\TextColumn::make('created_at')
                    ->sortable()
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                ExportBulkAction::make(),
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
            'index' => Pages\ListReservations::route('/'),
            'create' => Pages\CreateReservation::route('/create'),
            'edit' => Pages\EditReservation::route('/{record}/edit'),
        ];
    }
}
