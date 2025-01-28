<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 25;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label('Name'),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->unique()
                    ->label('Email'),
                Forms\Components\TextInput::make('phone')
                    ->required()
                    ->unique()
                    ->label('Phone'),
                Forms\Components\Select::make('gender')
                    ->options([
                        0 => 'Male',
                        1 => 'Female',
                    ])
                    ->required()
                    ->label('Gender'),
                // Using Select Component
                Forms\Components\Select::make('roles')
                    ->relationship('roles', 'name')
                    ->multiple()
                    ->preload()
                    ->searchable(),
                Forms\Components\DatePicker::make('BirthDate')
                    ->label('Birth Date'),
                SpatieMediaLibraryFileUpload::make('avatar')
                    ->collection('avatar'),



                Forms\Components\TextInput::make('SocialStatus')
                    ->label('Social Status'),
                // Forms\Components\Toggle::make('HasNotifications')
                //     ->label('Has Notifications')
                //     ->default(true),
                Forms\Components\TextInput::make('RelativesCount')
                    ->numeric()
                    ->label('Relatives Count'),
                Forms\Components\DateTimePicker::make('LastSeenAt')
                    ->label('Last Seen At')
                    ->disabled(),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->label('Password')
                    ->required(),
                Forms\Components\Hidden::make('CustomerID')
                    ->default(null),
                Forms\Components\Hidden::make('ZoneID')
                    ->default(null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('avatar')->collection('avatar'),

                Tables\Columns\TextColumn::make('name')->label('Name')->searchable(),
                Tables\Columns\TextColumn::make('email')->label('Email')->searchable(),
                Tables\Columns\TextColumn::make('phone')->label('Phone')->searchable(),
                Tables\Columns\TextColumn::make('gender')->label('Gender'),
                Tables\Columns\TextColumn::make('BirthDate')->label('Birth Date')->date()->searchable(),
                // Tables\Columns\TextColumn::make('LastSeenAt')->label('Last Seen At')->dateTime(),
                // Tables\Columns\BooleanColumn::make('HasNotifications')->label('Notifications Enabled'),

                // Tables\Columns\TextColumn::make('created_at')->label('Created At')->dateTime(),
                // Tables\Columns\TextColumn::make('updated_at')->label('Updated At')->dateTime(),
            ])
            ->filters([
                Filter::make('created_at')
                    ->form([
                        Select::make('BirthDate_from')
                            ->label('Birth Month From')
                            ->options([
                                '01' => 'January',
                                '02' => 'February',
                                '03' => 'March',
                                '04' => 'April',
                                '05' => 'May',
                                '06' => 'June',
                                '07' => 'July',
                                '08' => 'August',
                                '09' => 'September',
                                '10' => 'October',
                                '11' => 'November',
                                '12' => 'December',
                            ]),
                    ])->columnSpan(5)->columns(3)
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['BirthDate_from'],
                                fn(Builder $query, $month): Builder => $query->whereMonth('BirthDate', $month),
                            );

                    })
            ], FiltersLayout::AboveContent)
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
