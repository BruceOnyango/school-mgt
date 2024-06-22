<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExamResultResource\Pages;
use App\Filament\Resources\ExamResultResource\RelationManagers;
use App\Models\ExamResult;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ExamResultResource extends Resource
{
    protected static ?string $model = ExamResult::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {   /* 

         //  $table->foreignId('exam_id')->constrained('exams')->cascadeOnDelete();
          //  $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
            $table->integer('marks');
            $table->text('remarks')->nullable();
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
            Forms\Components\Select::make('exam_id')
                ->relationship('exam', 'name')
                ->searchable()
                ->preload()
                ->createOptionForm([
                    
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('description')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\DatePicker::make('date')
                        ->required(),
                ])
                ->required(),
            Forms\Components\TextInput::make('marks')
            ->required()
            ->maxLength(255),
            Forms\Components\TextInput::make('remarks')
                ->required()
                ->maxLength(255),
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
                Tables\Columns\TextColumn::make('exam.name', 'Exam Name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('marks', 'Marks'),
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
            'index' => Pages\ListExamResults::route('/'),
            'create' => Pages\CreateExamResult::route('/create'),
            'edit' => Pages\EditExamResult::route('/{record}/edit'),
        ];
    }
}
