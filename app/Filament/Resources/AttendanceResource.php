<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AttendanceResource\Pages;
use App\Filament\Resources\AttendanceResource\RelationManagers;
use App\Models\Attendance;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AttendanceResource extends Resource
{
    protected static ?string $model = Attendance::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {   /*
          //  $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
            $table->date('date');
            $table->string('status');
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
            Forms\Components\DatePicker::make('date')
                ->required(),
            Forms\Components\TextInput::make('status')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('remarks')
                ->nullable()
                ->maxLength(255),
           
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.first_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('date')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('remarks')
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
            'index' => Pages\ListAttendances::route('/'),
            'create' => Pages\CreateAttendance::route('/create'),
            'edit' => Pages\EditAttendance::route('/{record}/edit'),
        ];
    }
}
