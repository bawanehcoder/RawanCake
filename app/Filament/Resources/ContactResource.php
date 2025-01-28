<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\IconColumn;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    // protected static ?string $navigationIcon = 'heroicon-o-mail';
    protected static ?string $navigationLabel = 'Contacts';
    protected static ?string $navigationGroup = 'Communication';

    protected static ?int $navigationSort = 50;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('Date')
                    ->label('Date')
                    ->required(),
                Forms\Components\TextInput::make('Name')
                    ->label('Name')
                    ->required(),
                Forms\Components\TextInput::make('EMail')
                    ->label('Email')
                    ->email()
                    ->required(),
                Forms\Components\TextInput::make('Phone')
                    ->label('Phone')
                    ->tel()
                    ->required(),
                Forms\Components\Textarea::make('Message')
                    ->label('Message')
                    ->disabled(), // لجعل الرسالة قابلة للقراءة فقط
                Forms\Components\Textarea::make('Replay')
                    ->label('Reply'),
                Forms\Components\Toggle::make('IsReaded')
                    ->label('Is Read')
                    ->default(false),
                Forms\Components\Toggle::make('IsReplayed')
                    ->label('Is Replied')
                    ->default(false),
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('Date')->label('Date')->dateTime()->sortable(),
                Tables\Columns\TextColumn::make('Name')->label('Name')->searchable(),
                Tables\Columns\TextColumn::make('EMail')->label('Email')->searchable(),
                Tables\Columns\TextColumn::make('Phone')->label('Phone')->searchable(),
                Tables\Columns\TextColumn::make('Message')->label('Message')->limit(50),
                IconColumn::make('IsReaded')
                    ->label('Read')
                    ->boolean(),
                IconColumn::make('IsReplayed')
                    ->label('Replied')
                    ->boolean(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // أضف العلاقات هنا إذا كانت موجودة
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContacts::route('/'),
            'create' => Pages\CreateContact::route('/create'),
            'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }
}
