<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActionPointResource\Pages;
use App\Filament\Resources\ActionPointResource\RelationManagers;
use App\Models\ActionPoint;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ActionPointResource extends Resource
{
    protected static ?string $model = ActionPoint::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name'),
                TextInput::make('action')->readOnly(),
                TextInput::make('point')->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('action'),
                TextColumn::make('point'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
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
            'index' => Pages\ListActionPoints::route('/'),
            'create' => Pages\CreateActionPoint::route('/create'),
            'edit' => Pages\EditActionPoint::route('/{record}/edit'),
        ];
    }
}
