<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentResource\Pages;
use App\Filament\Resources\PaymentResource\RelationManagers;
use App\Models\Payment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {   
        /* 
        //   $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
            $table->decimal('amount', 8, 2);
            $table->date('date');
            $table->string('payment_method');
            $table->string('reference')->nullable();
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
            Forms\Components\TextInput::make('amount')
                ->required(),
            Forms\Components\TextInput::make('payment_method')
                ->required(),
            Forms\Components\TextInput::make('reference')
                ->nullable(),
            Forms\Components\DatePicker::make('date')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('student_id.first_name', 'Student First Name')
                ->searchable(),
            Tables\Columns\TextColumn::make('student_id.last_name', 'Student Last Name')
                ->searchable(),
            Tables\Columns\TextColumn::make('student_id.address', 'Student Address')
                ->searchable(),
            Tables\Columns\TextColumn::make('student_id.email', 'Student Email')
                ->searchable(),
            Tables\Columns\TextColumn::make('student_id.phone_number', 'Student Phone Number')
                ->searchable(),
            Tables\Columns\TextColumn::make('student_id.date_of_birth', 'Student Date of Birth'),
            Tables\Columns\TextColumn::make('student_id.date_of_admission', 'Student Date of Admission'),
            Tables\Columns\DecimalColumn::make('amount', 'Amount')->currency(),
            Tables\Columns\TextColumn::make('payment_method', 'Payment Method')
                ->searchable(),
            Tables\Columns\TextColumn::make('reference', 'Reference')
                ->nullable()
                ->searchable(),
            Tables\Columns\TextColumn::make('date', 'Date'),
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
            'index' => Pages\ListPayments::route('/'),
            'create' => Pages\CreatePayment::route('/create'),
            'edit' => Pages\EditPayment::route('/{record}/edit'),
        ];
    }
}
