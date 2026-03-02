<?php

namespace App\Filament\Resources;

use App\Enums\PostStatus;
use App\Filament\Resources\PostResource\Pages;
use App\Models\Category;
use App\Models\Post;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use UnitEnum;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-document-text';

    protected static string | UnitEnum | null $navigationGroup = 'Blog';

    public static function canAccess(): bool
    {
        return auth()->user()?->can('view posts') ?? false;
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->can('create posts') ?? false;
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()?->can('edit posts') ?? false;
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()?->can('delete posts') ?? false;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Forms\Components\TextInput::make('title')
                ->required()
                ->maxLength(255)
                ->live(onBlur: true)
                ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),

            Forms\Components\TextInput::make('slug')
                ->required()
                ->maxLength(255)
                ->unique(ignoreRecord: true),

            Forms\Components\Textarea::make('excerpt')
                ->maxLength(65535)
                ->columnSpanFull(),

            Forms\Components\RichEditor::make('content')
                ->columnSpanFull(),

            Forms\Components\SpatieMediaLibraryFileUpload::make('featured_image')
                ->collection('featured_image')
                ->image()
                ->columnSpanFull(),

            Forms\Components\Select::make('category_id')
                ->label('Category')
                ->relationship('category', 'name')
                ->searchable()
                ->preload(),

            Forms\Components\Select::make('tags')
                ->multiple()
                ->relationship('tags', 'name')
                ->searchable()
                ->preload(),

            Forms\Components\Select::make('status')
                ->options(PostStatus::class)
                ->default(PostStatus::Draft)
                ->required(),

            Forms\Components\DateTimePicker::make('published_at'),

            Forms\Components\Hidden::make('user_id')
                ->default(auth()->id()),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->sortable(),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Category')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('published_at')
                    ->dateTime()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(PostStatus::class),

                Tables\Filters\SelectFilter::make('category')
                    ->relationship('category', 'name'),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
