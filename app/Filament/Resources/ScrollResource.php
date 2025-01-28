<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ScrollResource\Pages;
use App\Filament\Resources\ScrollResource\RelationManagers;
use App\Models\Scroll;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ScrollResource extends Resource
{
    protected static ?string $model = Scroll::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name_ar')
                    ->label('Arabic Name')
                    ->required(),
                Forms\Components\TextInput::make('name_en')
                    ->label('English Name')
                    ->required(),
                Forms\Components\Textarea::make('content_ar')
                    ->label('Arabic Content')
                    ->nullable(),
                Forms\Components\Textarea::make('content_en')
                    ->label('English Content')
                    ->nullable(),
                FileUpload::make('image')
                    ->label('Image')
                   
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name_ar')->label('Arabic Name')->sortable(),
                Tables\Columns\TextColumn::make('name_en')->label('English Name')->sortable(),
                ImageColumn::make('image')->label('Image'),
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
            'index' => Pages\ListScrolls::route('/'),
            'create' => Pages\CreateScroll::route('/create'),
            'edit' => Pages\EditScroll::route('/{record}/edit'),
        ];
    }
}
