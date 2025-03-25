<?php

namespace App\Filament\Fields;

use Filament\Forms\Components\Field;

class MapField extends Field
{
    protected string $view = 'fields.map-field';

    protected string $apiKey;

    public function apiKey(string $apiKey): static
    {
        $this->apiKey = $apiKey;
        return $this;
    }

    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    public function getHref(): string
    {
        // Obtén la dirección del registro
        $order = $this->getRecord();
        $address = $order->order_address;

        // Codifica la dirección para usarla en la URL
        return 'https://www.google.com/maps?q=' . urlencode($address->full_address);
    }

    public function getAddress(): string
    {
        $order = $this->getRecord();
        $address = $order->order_address;

        // Retornar la dirección completa o un mensaje de error
        return $address ? $address->full_address : 'Dirección no disponible';
    }
}