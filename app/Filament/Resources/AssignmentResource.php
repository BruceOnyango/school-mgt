<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AssignmentResource\Pages;
use App\Filament\Resources\AssignmentResource\RelationManagers;
use App\Models\Assignment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AssignmentResource extends Resource
{
    protected static ?string $model = Assignment::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        /* 
         $table->string('title');
            $table->text('description');
            $table->date('due_date');
          //  $table->foreignId('classroom_id')->constrained('classrooms')->cascadeOnDelete();
          //  $table->foreignId('subject_id')->constrained('subjects')->cascadeOnDelete();
        */
        return $form
        ->schema([
            Forms\Components\TextInput::make('title')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('description')
                ->required(),
            Forms\Components\DatePicker::make('due_date')
                ->required(),
            Forms\Components\Select::make('class_id')
                ->relationship('classroom', 'name')
                ->searchable()
                ->preload()
                ->createOptionForm([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('grade_level')
                    ->required()
                    ->maxLength(255),
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
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description'),
                Tables\Columns\TextColumn::make('due_date')
                    ->sortable(),
                Tables\Columns\TextColumn::make('classroom.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('subject.name')
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
            'index' => Pages\ListAssignments::route('/'),
            'create' => Pages\CreateAssignment::route('/create'),
            'edit' => Pages\EditAssignment::route('/{record}/edit'),
        ];
    }
}
