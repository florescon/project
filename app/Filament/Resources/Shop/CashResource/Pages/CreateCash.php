<?php

namespace App\Filament\Resources\Shop\CashResource\Pages;

use App\Filament\Resources\Shop\CashResource;
use Filament\Actions;
use App\Models\Shop\Order;
use App\Models\Shop\Cash;
use Filament\Resources\Pages\CreateRecord;

class CreateCash extends CreateRecord
{
    protected static string $resource = CashResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Agregar el user_id y otros campos necesarios al array de datos
        $data['user_id'] = auth()->id();
        $data['is_processed'] = true;

        return $data;
    }

    protected function afterCreate(): void
    {
        // Obtener el registro de Cash recién creado
        $cash = $this->record;

        // Obtener todas las órdenes con cash_id = null
        $orders = Order::whereNull('cash_id')->get();

        // Actualizar las órdenes con el nuevo cash_id
        $orders->each(function ($order) use ($cash) {
            $order->update(['cash_id' => $cash->id]);
        });
    }

}