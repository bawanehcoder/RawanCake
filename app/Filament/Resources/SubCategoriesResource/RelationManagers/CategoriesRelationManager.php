<?php

namespace App\Filament\Resources\SubCategoriesResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CategoriesRelationManager extends RelationManager
{
    protected static string $relationship = 'categories';

    protected static ?string $title = 'Sub Categories';


    public function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                
                Forms\Components\Toggle::make('Visible')
                    ->label('Visible')
                    ->default(false),
            ]);
    }

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('Name'),
                Tables\Columns\TextColumn::make('NameEN'),
                Tables\Columns\TextColumn::make('SortIndex')->sortable(),
                Tables\Columns\IconColumn::make('Visible')
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->label('Create New Sub Category'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}