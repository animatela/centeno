<?php

namespace App\Filament\Resources\Workshop;

use App\Filament\Resources\Workshop\MakerResource\Pages;
use App\Filament\Resources\Workshop\MakerResource\RelationManagers;
use App\Models\Workshop\Maker;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MakerResource extends Resource
{
    protected static ?string $label = 'Fabricantes';

    protected static ?string $model = Maker::class;

    protected static ?string $slug = 'workshop/makers';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationGroup = 'Workshop';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->required(),
            Forms\Components\TextInput::make('slug')
                ->required(),
            Forms\Components\TextInput::make('website'),
            Forms\Components\MarkdownEditor::make('description')
                ->columnSpan('full'),
            Forms\Components\TextInput::make('email')
                ->email(),
            Forms\Components\TextInput::make('phone')
                ->tel(),
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
                //Tables\Columns\TextColumn::make('website'),
                //Tables\Columns\TextColumn::make('description'),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_visible')
                    ->boolean()
                    ->label('Visibility'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->date(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()
                    ->action(function () {
                        Notification::make()
                            ->title('Now, now, don\'t be cheeky, leave some records for others to play with!')
                            ->warning()
                            ->send();
                    }),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageMakers::route('/'),
        ];
    }
}
