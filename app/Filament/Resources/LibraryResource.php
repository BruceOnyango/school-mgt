<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LibraryResource\Pages;
use App\Filament\Resources\LibraryResource\RelationManagers;
use App\Models\Library;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LibraryResource extends Resource
{
    protected static ?string $model = Library::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\TextInput::make('title')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('author')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('isbn')
                ->required()
                ->unique()
                ->maxLength(255),
            Forms\Components\DatePicker::make('published_date')
                ->required(),
            Forms\Components\TextInput::make('category')
                ->required()
                ->maxLength(255),
            Forms\Components\Select::make('status')
                ->options(['Available', 'Unavailable'])
                ->required(),
        ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('author'),
                Tables\Columns\TextColumn::make('isbn'),
                Tables\Columns\TextColumn::make('published_date')
                    ->sortable(),
                Tables\Columns\TextColumn::make('category'),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\DateTimeColumn::make('created_at')
                    ->sortable()
                    ->label('Created At'),
                Tables\Columns\DateTimeColumn::make('updated_at')
                    ->sortable()
                    ->label('Updated At'),
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
            'index' => Pages\ListLibraries::route('/'),
            'create' => Pages\CreateLibrary::route('/create'),
            'edit' => Pages\EditLibrary::route('/{record}/edit'),
        ];
    }
}
