<?php

namespace App\Filament\Resources\LibraryTransactionResource\Pages;

use App\Filament\Resources\LibraryTransactionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLibraryTransactions extends ListRecords
{
    protected static string $resource = LibraryTransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
