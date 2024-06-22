<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TimetableResource\Pages;
use App\Filament\Resources\TimetableResource\RelationManagers;
use App\Models\Timetable;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TimetableResource extends Resource
{
    protected static ?string $model = Timetable::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {   /* 
        
             //  $table->foreignId('classroom_id')->constrained('classrooms')->cascadeOnDelete();
          //  $table->foreignId('subject_id')->constrained('subjects')->cascadeOnDelete();
            $table->string('day_of_week');
            $table->time('start_time');
            $table->time('end_time');
        */
        return $form
        ->schema([
            Forms\Components\Select::make('classroom_id')
            ->relationship('classroom', 'name')
            ->searchable()
            ->preload()
            ->createOptionForm([
                
                Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),
            Forms\Components\Select::make('teacher_id')
                ->relationship('teacher', 'first_name')
                ->searchable()
                ->preload()
                ->createOptionForm([
                    Forms\Components\TextInput::make('first_name')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('last_name')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\DatePicker::make('date_of_birth')
                        ->required(),
                    Forms\Components\TextInput::make('address')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('email')
                        ->label('Email address')
                        ->email()
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('phone')
                        ->label('Phone number')
                        ->tel()
                        ->required(),
                    Forms\Components\DatePicker::make('hire_date')
                        ->required(),
                ])
                ->nullable(),
            ])
            ->required(),
            Forms\Components\Select::make('student_id')
            ->relationship('student', 'first_name')
            ->searchable()
            ->preload()
            ->createOptionForm([
                Forms\Components\TextInput::make('first_name')
            ->required()
            ->maxLength(255),
        Forms\Components\TextInput::make('last_name')
            ->required()
            ->maxLength(255),
        Forms\Components\TextInput::make('address')
            ->required()
            ->maxLength(255),
        Forms\Components\TextInput::make('email')
            ->required()
            ->maxLength(255),
        Forms\Components\TextInput::make('phone_number')
            ->label('Phone number')
            ->tel()
            ->required(),
        Forms\Components\DatePicker::make('date_of_birth')
            ->required(),
        Forms\Components\DatePicker::make('date_of_admission')
            ->required(),
            /* Forms\Components\Select::make('class_id')
                    ->relationship('classroom', 'name')
                    ->searchable()
                    ->preload()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                    ])
                    ->required(),
            ]);*/
            ])
            ->required(),
            Forms\Components\TimePicker::make('start_time')
                ->required(),
            Forms\Components\TimePicker::make('end_time')
                ->required(),//day_of_week
            Forms\Components\TimePicker::make('day_of_week')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('classroom_id.name', 'Classroom Name')
                ->searchable(),
            Tables\Columns\TextColumn::make('teacher_id.first_name', 'Teacher First Name')
                ->searchable(),
            Tables\Columns\TextColumn::make('teacher_id.last_name', 'Teacher Last Name')
                ->searchable(),
            Tables\Columns\TextColumn::make('teacher_id.date_of_birth', 'Teacher Date of Birth'),
            Tables\Columns\TextColumn::make('teacher_id.address', 'Teacher Address')
                ->searchable(),
            Tables\Columns\TextColumn::make('teacher_id.email', 'Teacher Email')
                ->searchable(),
            Tables\Columns\TextColumn::make('teacher_id.phone', 'Teacher Phone')
                ->searchable(),
            Tables\Columns\TextColumn::make('teacher_id.hire_date', 'Teacher Hire Date'),
            Tables\Columns\TextColumn::make('student_id.first_name', 'Student First Name')
                ->searchable(),
            Tables\Columns\TextColumn::make('student_id.last_name', 'Student Last Name')
                ->searchable(),
            Tables\Columns\TextColumn::make('student_id.date_of_birth', 'Student Date of Birth'),
            Tables\Columns\TextColumn::make('student_id.address', 'Student Address')
                ->searchable(),
            Tables\Columns\TextColumn::make('student_id.email', 'Student Email')
                ->searchable(),
            Tables\Columns\TextColumn::make('student_id.phone_number', 'Student Phone')
                ->searchable(),
            Tables\Columns\TextColumn::make('student_id.date_of_admission', 'Student Admission Date'),
            Tables\Columns\TextColumn::make('day_of_week', 'Day of Week'),
            Tables\Columns\TimeColumn::make('start_time', 'Start Time'),
            Tables\Columns\TimeColumn::make('end_time', 'End Time'),
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
            'index' => Pages\ListTimetables::route('/'),
            'create' => Pages\CreateTimetable::route('/create'),
            'edit' => Pages\EditTimetable::route('/{record}/edit'),
        ];
    }
}
