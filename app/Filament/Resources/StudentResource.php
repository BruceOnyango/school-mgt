<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Filament\Resources\StudentResource\RelationManagers;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            //
            /*
            $table->string('first_name');
        $table->string('last_name');
        $table->date('dob');
        $table->string('address');
        $table->string('email');
        $table->string('phone_number');
        $table->date('admission_date');
            */
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
            Forms\Components\DatePicker::make('dob')
                ->required(),
            Forms\Components\DatePicker::make('date_of_admission')
                ->required(),
            Forms\Components\Select::make('class_id')
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
            Tables\Columns\TextColumn::make('first_name', 'First Name')
                ->searchable(),
            Tables\Columns\TextColumn::make('last_name', 'Last Name')
                ->searchable(),
            Tables\Columns\TextColumn::make('dob', 'Date of Birth'),
            Tables\Columns\TextColumn::make('address', 'Address')
                ->searchable(),
            Tables\Columns\TextColumn::make('email', 'Email')
                ->searchable(),
            Tables\Columns\TextColumn::make('phone_number', 'Phone Number')
                ->searchable(),
            Tables\Columns\TextColumn::make('date_of_admission', 'Date of Admission'),
            Tables\Columns\TextColumn::make('class_id.name', 'Classroom Name')
                ->searchable(),
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
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
}
