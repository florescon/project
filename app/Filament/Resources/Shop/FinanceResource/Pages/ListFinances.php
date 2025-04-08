<?php

namespace App\Filament\Resources\Shop\FinanceResource\Pages;

use App\Filament\Resources\Shop\FinanceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFinances extends ListRecords
{
    protected static string $resource = FinanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
