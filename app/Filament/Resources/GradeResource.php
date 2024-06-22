<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GradeResource\Pages;
use App\Filament\Resources\GradeResource\RelationManagers;
use App\Models\Grade;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GradeResource extends Resource
{
    protected static ?string $model = Grade::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {   
        /* 
        //  $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
            //$table->foreignId('subject_id')->constrained('subjects')->cascadeOnDelete();
            $table->string('grade');
            $table->text('remarks')->nullable();
            $table->date('date');
        
        */
        return $form
            ->schema([

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
                Forms\Components\Select::make('subject_id')
                    ->relationship('subject', 'name')
                    ->searchable()
                    ->preload()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('description')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('code')
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
                            ->required(),
                    ])
                    ->required(),
                Forms\Components\TextInput::make('grade')
                    ->required(),
                Forms\Components\TextInput::make('remarks')
                    ->required(),
                Forms\Components\DatePicker::make('date')
                    ->required(),
               
            ]);
           
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.first_name', 'Student First Name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('student.last_name', 'Student Last Name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('subject.name', 'Subject Name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('grade', 'Grade'),
                Tables\Columns\TextColumn::make('date', 'Date'),
                Tables\Columns\TextColumn::make('remarks', 'Remarks')
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
            'index' => Pages\ListGrades::route('/'),
            'create' => Pages\CreateGrade::route('/create'),
            'edit' => Pages\EditGrade::route('/{record}/edit'),
        ];
    }
}
