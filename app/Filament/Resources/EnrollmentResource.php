<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EnrollmentResource\Pages;
use App\Filament\Resources\EnrollmentResource\RelationManagers;
use App\Models\Enrollment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EnrollmentResource extends Resource
{
    protected static ?string $model = Enrollment::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {   
        /*
         //  $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
          //  $table->foreignId('classroom_id')->constrained('classrooms')->cascadeOnDelete();
            $table->date('enrollment_date');
            $table->timestamps();
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
            Forms\Components\Select::make('classroom_id')
                ->relationship('classroom', 'name')
                ->searchable()
                ->preload()
                ->createOptionForm([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                ])
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('student.first_name')
                ->searchable(),
            Tables\Columns\TextColumn::make('student.last_name')
                ->searchable(),
            Tables\Columns\TextColumn::make('classroom.name')
                ->searchable(),
            Tables\Columns\TextColumn::make('enrollment_date')
                ->sortable(),
            Tables\Columns\TextColumn::make('created_at')
                ->sortable(),
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
            'index' => Pages\ListEnrollments::route('/'),
            'create' => Pages\CreateEnrollment::route('/create'),
            'edit' => Pages\EditEnrollment::route('/{record}/edit'),
        ];
    }
}
