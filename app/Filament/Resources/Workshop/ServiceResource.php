<?php

namespace App\Filament\Resources\Workshop;

use App\Filament\Resources\Workshop\ServiceResource\Pages;
use App\Filament\Resources\Workshop\ServiceResource\RelationManagers;
use App\Models\Workshop\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class ServiceResource extends Resource
{
    protected static ?string $label = 'Servicios';

    protected static ?string $model = Service::class;

    protected static ?string $slug = 'workshop/services';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationGroup = 'Workshop';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxValue(100)
                    ->lazy()
                    ->afterStateUpdated(
                        fn (string $context, $state, callable $set) => $context === 'create' ? $set('slug', Str::slug($state)) : null
                    ),

                Forms\Components\TextInput::make('slug')
                    ->disabled()
                    ->required()
                    ->unique(Service::class, 'slug', ignoreRecord: true),

                Forms\Components\MarkdownEditor::make('description')
                    ->columnSpan('full'),

                //Forms\Components\TextInput::make('type'),
                //Forms\Components\TextInput::make('position')->required(),

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
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                //Tables\Columns\TextColumn::make('slug'),
                //Tables\Columns\TextColumn::make('description'),
                Tables\Columns\TextColumn::make('type')
                    ->searchable()
                    ->sortable(),
                //Tables\Columns\TextColumn::make('position'),
                Tables\Columns\IconColumn::make('is_visible')
                    ->boolean(),
                //Tables\Columns\TextColumn::make('seo_title'),
                //Tables\Columns\TextColumn::make('seo_description'),
                //Tables\Columns\TextColumn::make('sort'),
                //Tables\Columns\TextColumn::make('created_at')->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')->date(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ItemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
