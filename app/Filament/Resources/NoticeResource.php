<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NoticeResource\Pages;
use App\Filament\Resources\NoticeResource\RelationManagers;
use App\Models\Notice;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NoticeResource extends Resource
{
    protected static ?string $model = Notice::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {   /* 
         $table->string('title');
            $table->text('description');
            $table->date('date');
         //   $table->foreignId('posted_by')->constrained('teachers')->cascadeOnDelete();
        
        */
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->required(),
                Forms\Components\DatePicker::make('date')
                    ->required(),

                Forms\Components\Select::make('posted_by')
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
            Tables\Columns\TextColumn::make('title', 'Title')
                ->searchable(),
            Tables\Columns\TextColumn::make('description', 'Description')
                ->searchable(),
            Tables\Columns\TextColumn::make('date', 'Date'),
            Tables\Columns\TextColumn::make('posted_by.first_name', 'Posted By First Name')
                ->searchable(),
            Tables\Columns\TextColumn::make('posted_by.last_name', 'Posted By Last Name')
                ->searchable(),
            Tables\Columns\TextColumn::make('posted_by.date_of_birth', 'Posted By Date of Birth'),
            Tables\Columns\TextColumn::make('posted_by.address', 'Posted By Address'),
            Tables\Columns\TextColumn::make('posted_by.email', 'Posted By Email')
                ->searchable(),
            Tables\Columns\TextColumn::make('posted_by.phone', 'Posted By Phone')
                ->searchable(),
            Tables\Columns\TextColumn::make('posted_by.hire_date', 'Posted By Hire Date'),
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
            'index' => Pages\ListNotices::route('/'),
            'create' => Pages\CreateNotice::route('/create'),
            'edit' => Pages\EditNotice::route('/{record}/edit'),
        ];
    }
}
