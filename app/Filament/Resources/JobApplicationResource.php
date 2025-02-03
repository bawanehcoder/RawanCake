<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JobApplicationResource\Pages;
use App\Models\JobApplication;
use Filament\Forms; 
use Filament\Resources\Form; 
use Filament\Resources\Resource; 
use Filament\Resources\Table; 
use Filament\Tables; 

class JobApplicationResource extends Resource
{
    protected static ?string $model = JobApplication::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationLabel = 'Job Applications';
    protected static ?string $pluralLabel = 'Job Applications';
    protected static ?string $slug = 'job-applications';

    public static function form(Forms\Form $form): Forms\Form 
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('full_name')->label('Full Name')->required(),
                Forms\Components\TextInput::make('nationality')->label('Nationality')->required(),
                Forms\Components\TextInput::make('birthplace')->label('Place of Birth')->required(),
                Forms\Components\DatePicker::make('dob')->label('Date of Birth')->required(),
                Forms\Components\TextInput::make('national_id')->label('National ID')->required(),
                Forms\Components\Select::make('gender')
                    ->options([
                        'male' => 'Male',
                        'female' => 'Female',
                    ])
                    ->label('Gender')
                    ->required(),
                Forms\Components\Select::make('smoker')
                    ->options([
                        'yes' => 'Yes',
                        'no' => 'No',
                    ])
                    ->label('Smoker')
                    ->required(),
                Forms\Components\Select::make('currently_employed')
                    ->options([
                        'yes' => 'Yes',
                        'no' => 'No',
                    ])
                    ->label('Currently Employed')
                    ->required(),
                Forms\Components\TextInput::make('phone')->label('Phone')->required(),
                Forms\Components\TextInput::make('email')->label('Email')->email()->required(),
                Forms\Components\TextInput::make('address')->label('Address')->required(),
                Forms\Components\TextInput::make('qualification')->label('Qualification')->required(),
                Forms\Components\TextInput::make('major')->label('Major')->required(),
                Forms\Components\TextInput::make('grade')->label('Grade')->required(),
                Forms\Components\TextInput::make('university')->label('University')->required(),
                Forms\Components\TextInput::make('graduation_year')->label('Graduation Year')->required(),
                Forms\Components\Select::make('reading_english')
                    ->options([
                        'yes' => 'Yes',
                        'no' => 'No',
                    ])
                    ->label('Reading English')
                    ->required(),
                Forms\Components\Select::make('writing_english')
                    ->options([
                        'yes' => 'Yes',
                        'no' => 'No',
                    ])
                    ->label('Writing English')
                    ->required(),
                Forms\Components\Select::make('speaking_english')
                    ->options([
                        'yes' => 'Yes',
                        'no' => 'No',
                    ])
                    ->label('Speaking English')
                    ->required(),
                Forms\Components\Select::make('reading_arabic')
                    ->options([
                        'yes' => 'Yes',
                        'no' => 'No',
                    ])
                    ->label('Reading Arabic')
                    ->required(),
                Forms\Components\Select::make('writing_arabic')
                    ->options([
                        'yes' => 'Yes',
                        'no' => 'No',
                    ])
                    ->label('Writing Arabic')
                    ->required(),
                Forms\Components\Select::make('speaking_arabic')
                    ->options([
                        'yes' => 'Yes',
                        'no' => 'No',
                    ])
                    ->label('Speaking Arabic')
                    ->required(),
                Forms\Components\Textarea::make('experience')->label('Experience')->required(),
                Forms\Components\Textarea::make('courses')->label('Courses')->required(),
                Forms\Components\Select::make('agree')
                    ->options([
                        'yes' => 'Yes',
                        'no' => 'No',
                    ])
                    ->label('Agree to Terms')
                    ->required(),
                Forms\Components\TextInput::make('job_position')->label('Job Position')->required(),
                Forms\Components\TextInput::make('min_salary')->label('Minimum Salary')->numeric()->required(),
                Forms\Components\TextInput::make('branch')->label('Branch')->required(),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table 
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('full_name')->label('Full Name'),
                Tables\Columns\TextColumn::make('nationality')->label('Nationality'),
                Tables\Columns\TextColumn::make('birthplace')->label('Place of Birth'),
                Tables\Columns\TextColumn::make('dob')->label('Date of Birth')->date(),
                Tables\Columns\TextColumn::make('national_id')->label('National ID'),
                Tables\Columns\TextColumn::make('gender')->label('Gender'),
                Tables\Columns\TextColumn::make('smoker')->label('Smoker'),
                Tables\Columns\TextColumn::make('currently_employed')->label('Currently Employed'),
                Tables\Columns\TextColumn::make('phone')->label('Phone'),
                Tables\Columns\TextColumn::make('email')->label('Email'),
                Tables\Columns\TextColumn::make('address')->label('Address'),
                Tables\Columns\TextColumn::make('qualification')->label('Qualification'),
                Tables\Columns\TextColumn::make('major')->label('Major'),
                Tables\Columns\TextColumn::make('grade')->label('Grade'),
                Tables\Columns\TextColumn::make('university')->label('University'),
                Tables\Columns\TextColumn::make('graduation_year')->label('Graduation Year'),
                Tables\Columns\TextColumn::make('reading_english')->label('Reading English'),
                Tables\Columns\TextColumn::make('writing_english')->label('Writing English'),
                Tables\Columns\TextColumn::make('speaking_english')->label('Speaking English'),
                Tables\Columns\TextColumn::make('reading_arabic')->label('Reading Arabic'),
                Tables\Columns\TextColumn::make('writing_arabic')->label('Writing Arabic'),
                Tables\Columns\TextColumn::make('speaking_arabic')->label('Speaking Arabic'),
                Tables\Columns\TextColumn::make('experience')->label('Experience'),
                Tables\Columns\TextColumn::make('courses')->label('Courses'),
                Tables\Columns\TextColumn::make('agree')->label('Agree to Terms'),
                Tables\Columns\TextColumn::make('job_position')->label('Job Position'),
                Tables\Columns\TextColumn::make('min_salary')->label('Minimum Salary')->money('USD'),
                Tables\Columns\TextColumn::make('branch')->label('Branch'),
                Tables\Columns\TextColumn::make('created_at')->label('Created At')->dateTime(),
            ])
            ->filters([
           ]);
    }

    public static function getRelations(): array
    {
        return [

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJobApplications::route('/'),
            'create' => Pages\CreateJobApplication::route('/create'),
            'edit' => Pages\EditJobApplication::route('/{record}/edit'),
        ];
    }
}
