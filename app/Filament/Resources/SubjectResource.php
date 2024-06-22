<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubjectResource\Pages;
use App\Filament\Resources\SubjectResource\RelationManagers;
use App\Models\Subject;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SubjectResource extends Resource
{
    protected static ?string $model = Subject::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                /*
                $table->string('name');
            $table->text('description')->nullable();
            $table->string('code')->unique();
                 */

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
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('name', 'Name')
                ->searchable(),
            Tables\Columns\TextColumn::make('description', 'Description')
                ->searchable(),
            Tables\Columns\TextColumn::make('code', 'Code')
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
            'index' => Pages\ListSubjects::route('/'),
            'create' => Pages\CreateSubject::route('/create'),
            'edit' => Pages\EditSubject::route('/{record}/edit'),
        ];
    }
}
