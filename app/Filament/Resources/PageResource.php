<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Filament\Resources\PageResource\RelationManagers;
use App\Models\Page;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    
    protected static ?string $navigationLabel = 'Pages';
    protected static ?string $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 21;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->label('Page Title'),
                Forms\Components\TextInput::make('route_name')
                    ->required()
                    ->label('Route Name'),
                RichEditor::make('content.ar')
                    ->placeholder('Write something amazing...')
                    ->columnSpan(2),
                    RichEditor::make('content.en')
                    ->placeholder('Write something amazing...')
                    ->columnSpan(2),
                    // ->required(),
                // Forms\Components\FileUpload::make('blob')
                //     ->label('Blob'),
                // Forms\Components\DateTimePicker::make('created_at')
                // ->disabled(),
                // Forms\Components\DateTimePicker::make('updated_at')
                // ->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('Title')->searchable(),
                Tables\Columns\TextColumn::make('route_name')->label('Route Name')->searchable(),
                Tables\Columns\TextColumn::make('content')->label('Content')->limit(50)->html(),
                Tables\Columns\TextColumn::make('created_at')->label('Created At')->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')->label('Updated At')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
