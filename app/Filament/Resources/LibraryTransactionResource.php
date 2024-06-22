<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LibraryTransactionResource\Pages;
use App\Filament\Resources\LibraryTransactionResource\RelationManagers;
use App\Models\LibraryTransaction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LibraryTransactionResource extends Resource
{
    protected static ?string $model = LibraryTransaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {   
        /* 
         // $table->foreignId('book_id')->constrained('library_books')->cascadeOnDelete();
          //  $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
            $table->date('borrowed_date');
            $table->date('due_date');
            $table->date('returned_date')->nullable();
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
            Forms\Components\Select::make('book_id')
                ->relationship('book', 'title')
                ->searchable()
                ->preload()
                ->createOptionForm([
                    
                    Forms\Components\TextInput::make('title')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('author')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('isbn')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('category')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('status')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\DatePicker::make('published_date')
                        ->required(),
                ])
                ->required(),
            Forms\Components\DatePicker::make('borrowed_date')
                ->required(),
            Forms\Components\DatePicker::make('returned_date')
                ->nullable(),
            Forms\Components\DatePicker::make('due_date')
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
                Tables\Columns\TextColumn::make('book.title', 'Book Title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('book.author', 'Author')
                    ->searchable(),
                Tables\Columns\TextColumn::make('book.isbn', 'ISBN')
                    ->searchable(),
                Tables\Columns\TextColumn::make('book.category', 'Category')
                    ->searchable(),
                Tables\Columns\TextColumn::make('book.status', 'Status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('book.published_date', 'Published Date'),
                Tables\Columns\TextColumn::make('borrowed_date', 'Borrowed Date'),
                Tables\Columns\TextColumn::make('returned_date', 'Returned Date'),
                Tables\Columns\TextColumn::make('due_date', 'Due Date'),
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
            'index' => Pages\ListLibraryTransactions::route('/'),
            'create' => Pages\CreateLibraryTransaction::route('/create'),
            'edit' => Pages\EditLibraryTransaction::route('/{record}/edit'),
        ];
    }
}
