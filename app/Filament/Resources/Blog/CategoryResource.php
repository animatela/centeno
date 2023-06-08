<?php

namespace App\Filament\Resources\Blog;

use App\Filament\Resources\Blog\CategoryResource\Pages;
use App\Models\Blog\Category;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Support\Str;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $slug = 'blog/categories';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationGroup = 'Blog';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?int $navigationSort = 1;

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxValue(50)
                ->lazy()
                ->afterStateUpdated(
                    fn (string $context, $state, callable $set) => $context === 'create' ? $set('slug', Str::slug($state)) : null
                ),
            Forms\Components\TextInput::make('slug')
                ->disabled()
                ->required()
                ->unique(Category::class, 'slug', ignoreRecord: true),
            Forms\Components\MarkdownEditor::make('description')
                ->columnSpan('full'),
            Forms\Components\Toggle::make('is_visible')
                ->label('Visible to customers.')
                ->default(true),
            //Forms\Components\TextInput::make('seo_title'),
            //Forms\Components\TextInput::make('seo_description'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('slug'),
                //Tables\Columns\TextColumn::make('description'),
                Tables\Columns\IconColumn::make('is_visible')
                    ->boolean()
                    ->label('Visibility'),
                //Tables\Columns\TextColumn::make('seo_title'),
                //Tables\Columns\TextColumn::make('seo_description'),
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
            'index' => Pages\ManageCategories::route('/'),
        ];
    }
}
