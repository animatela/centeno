<?php

namespace App\Filament\Resources\Workshop;

use App\Filament\Resources\Workshop\VehicleResource\Pages;
use App\Filament\Resources\Workshop\VehicleResource\RelationManagers;
use App\Models\Workshop\Vehicle;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VehicleResource extends Resource
{
    protected static ?string $label = 'Vehículos';

    protected static ?string $model = Vehicle::class;

    protected static ?string $slug = 'workshop/vehicles';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationGroup = 'Workshop';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //Forms\Components\TextInput::make('workshop_maker_id'),
                //Forms\Components\TextInput::make('workshop_customer_id'),
                Forms\Components\TextInput::make('name')
                    ->maxValue(100)
                    ->required(),

                Forms\Components\TextInput::make('type'),

                Forms\Components\TextInput::make('model'),

                Forms\Components\TextInput::make('year'),
                //Forms\Components\TextInput::make('color'),
                //Forms\Components\TextInput::make('fuel_type'),
                //Forms\Components\TextInput::make('engine_size'),
                //Forms\Components\TextInput::make('transmission_type'),
                //Forms\Components\TextInput::make('vin'),

                Forms\Components\TextInput::make('plate'),

                Forms\Components\TextInput::make('mileage')
                    ->required(),

                Forms\Components\Toggle::make('is_visible')
                    ->label('Visible to customers.')
                    ->default(true),

                //Forms\Components\TextInput::make('seo_title'),
                //Forms\Components\TextInput::make('seo_description'),
                //Forms\Components\TextInput::make('sort'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('workshop_maker_id'),
                Tables\Columns\TextColumn::make('workshop_customer_id'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('slug'),
                Tables\Columns\TextColumn::make('type'),
                Tables\Columns\TextColumn::make('model'),
                Tables\Columns\TextColumn::make('year'),
                Tables\Columns\TextColumn::make('color'),
                Tables\Columns\TextColumn::make('fuel_type'),
                Tables\Columns\TextColumn::make('engine_size'),
                Tables\Columns\TextColumn::make('transmission_type'),
                Tables\Columns\TextColumn::make('vin'),
                Tables\Columns\TextColumn::make('plate'),
                Tables\Columns\TextColumn::make('mileage'),
                Tables\Columns\IconColumn::make('is_visible')
                    ->boolean(),
                Tables\Columns\TextColumn::make('seo_title'),
                Tables\Columns\TextColumn::make('seo_description'),
                Tables\Columns\TextColumn::make('sort'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageVehicles::route('/'),
        ];
    }
}
