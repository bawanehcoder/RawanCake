<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BranchResource\Pages;
use App\Filament\Resources\BranchResource\RelationManagers;
use App\Models\Branche;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BranchResource extends Resource
{
    protected static ?string $model = Branche::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 32;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('AddresAr')
                ->label('Address (Arabic)')
                ->required(),
            Forms\Components\TextInput::make('AddresEn')
                ->label('Address (English)')
                ->required(),
            Forms\Components\TextInput::make('Phone')
                ->label('Phone')
                ->tel()
                ->required(),
            Forms\Components\TextInput::make('Map')
                ->label('Map URL')
                ->url(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('AddresAr')->label('Address (Arabic)'),
                Tables\Columns\TextColumn::make('AddresEn')->label('Address (English)'),
                Tables\Columns\TextColumn::make('Phone')->label('Phone'),
                Tables\Columns\TextColumn::make('Map')->label('Map URL'),
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
            'index' => Pages\ListBranches::route('/'),
            'create' => Pages\CreateBranch::route('/create'),
            'edit' => Pages\EditBranch::route('/{record}/edit'),
        ];
    }
}
