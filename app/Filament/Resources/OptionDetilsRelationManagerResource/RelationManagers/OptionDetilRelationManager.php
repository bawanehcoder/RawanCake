<?php

namespace App\Filament\Resources\OptionDetilsRelationManagerResource\RelationManagers;

use App\Models\ItemOption;
use App\Models\SubOption;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OptionDetilRelationManager extends RelationManager
{
    protected static string $relationship = 'optionDetil';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Toggle::make('active'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('option.Name'),
                Tables\Columns\TextColumn::make('subOption.Name'),
                Tables\Columns\TextColumn::make('AdditionalValue'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
