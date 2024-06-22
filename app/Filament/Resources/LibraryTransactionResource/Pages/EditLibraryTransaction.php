<?php

namespace App\Filament\Resources\LibraryTransactionResource\Pages;

use App\Filament\Resources\LibraryTransactionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLibraryTransaction extends EditRecord
{
    protected static string $resource = LibraryTransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
