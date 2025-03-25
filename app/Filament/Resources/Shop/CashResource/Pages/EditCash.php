<?php

namespace App\Filament\Resources\Shop\CashResource\Pages;

use App\Filament\Resources\Shop\CashResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCash extends EditRecord
{
    protected static string $resource = CashResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
