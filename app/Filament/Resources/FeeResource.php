<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeeResource\Pages;
use App\Filament\Resources\FeeResource\RelationManagers;
use App\Models\Fee;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FeeResource extends Resource
{
    protected static ?string $model = Fee::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {   /* 
             //   $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
            $table->decimal('amount', 8, 2);
            $table->date('due_date');
            $table->string('status');
        */
        return $form
        ->schema([
            Forms\Components\TextInput::make('status')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('amount')
                ->required(),
            Forms\Components\DatePicker::make('due_date')
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
                Tables\Columns\TextColumn::make('amount', 'Amount'),
                Tables\Columns\TextColumn::make('due_date', 'Due Date'),
                Tables\Columns\TextColumn::make('status', 'Status'),
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
            'index' => Pages\ListFees::route('/'),
            'create' => Pages\CreateFee::route('/create'),
            'edit' => Pages\EditFee::route('/{record}/edit'),
        ];
    }
}
