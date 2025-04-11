<?php

namespace App\Filament\Resources\Shop\ConsumableResource\Pages;

use App\Filament\Resources\Shop\ConsumableResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditConsumable extends EditRecord
{
    protected static string $resource = ConsumableResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
