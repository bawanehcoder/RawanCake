<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Filament\Resources\SubCategoriesResource\RelationManagers\CategoriesRelationManager;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Products and Categories';

    protected static ?string $navigationLabel = 'Categories';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
        ->schema([

            Forms\Components\Toggle::make('Visible')
                ->label('Visible')
                ->default(true),
         
        ]);

    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            // Tables\Columns\TextColumn::make('id')->sortable(),
            // Tables\Columns\TextColumn::make('CatID'),
            // Tables\Columns\TextColumn::make('blob'),
            Tables\Columns\TextColumn::make('Name'),
            Tables\Columns\TextColumn::make('NameEN'),
            Tables\Columns\TextColumn::make('ShortcutName'),
            Tables\Columns\TextColumn::make('ShortcutNameEN'),
            // Tables\Columns\TextColumn::make('SortIndex')->sortable(),
            Tables\Columns\IconColumn::make('Visible')
                ->boolean(),
            // Tables\Columns\TextColumn::make('created_at')
            //     ->dateTime(),
            // Tables\Columns\TextColumn::make('updated_at')
            //     ->dateTime(),
        ])
        ->filters([
            Filter::make('Name')
            ->form([
                Forms\Components\TextInput::make('Name')
                    ->label('Name')
                    ->placeholder('Search by Name...'),
            ])
            ->query(function (Builder $query, array $data): Builder {
                return $query->when(
                    $data['Name'] ?? null,
                    fn ($query, $term) => $query->where('Name', 'like', "%{$term}%")
                );
            }),

            Filter::make('NameEN')
            ->form([
                Forms\Components\TextInput::make('NameEN')
                    ->label('NameEN')
                    ->placeholder('Search by NameEN...'),
            ])
            ->query(function (Builder $query, array $data): Builder {
                return $query->when(
                    $data['NameEN'] ?? null,
                    fn ($query, $term) => $query->where('NameEN', 'like', "%{$term}%")
                );
            }),


            Filter::make('ShortcutName')
            ->form([
                Forms\Components\TextInput::make('ShortcutName')
                    ->label('ShortcutName')
                    ->placeholder('Search by ShortcutName...'),
            ])
            ->query(function (Builder $query, array $data): Builder {
                return $query->when(
                    $data['ShortcutName'] ?? null,
                    fn ($query, $term) => $query->where('ShortcutName', 'like', "%{$term}%")
                );
            }),

            Filter::make('ShortcutNameEN')
            ->form([
                Forms\Components\TextInput::make('ShortcutNameEN')
                    ->label('ShortcutNameEN')
                    ->placeholder('Search by ShortcutNameEN...'),
            ])
            ->query(function (Builder $query, array $data): Builder {
                return $query->when(
                    $data['ShortcutNameEN'] ?? null,
                    fn ($query, $term) => $query->where('ShortcutNameEN', 'like', "%{$term}%")
                );
            }),

            Filter::make('Visible'),
        ],
        FiltersLayout::AboveContent)
        ->actions([
            // Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            // Tables\Actions\DeleteBulkAction::make(),
        ]);
    }

    public static function getRelations(): array
    {
        return [
            CategoriesRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            // 'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
