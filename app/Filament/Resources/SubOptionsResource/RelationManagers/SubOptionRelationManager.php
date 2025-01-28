<?php

namespace App\Filament\Resources\SubOptionsResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SubOptionRelationManager extends RelationManager
{
    protected static string $relationship = 'subOption';

    public function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\TextInput::make('Name')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('NameEN')
                ->required()
                ->maxLength(255),
            Forms\Components\Toggle::make('Available')
                ->label('Available')
                ->default(true),
            // Forms\Components\TextInput::make('blob')
            //     ->maxLength(255),
            // Forms\Components\TextInput::make('ModifierID')
            //     ->numeric()
            //     ->label('Modifier ID'),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('Name'),
                Tables\Columns\TextColumn::make('NameEN'),
                Tables\Columns\IconColumn::make('Available')
                    ->boolean(),
                // Tables\Columns\TextColumn::make('blob'),
                Tables\Columns\TextColumn::make('ModifierID'),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
