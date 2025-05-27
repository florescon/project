<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum OrderShipping: string implements HasColor, HasIcon, HasLabel
{
    case Local = 'local';
    case Takeaway = 'takeaway';
    case Delivery = 'delivery';

    public function getLabel(): string
    {
        return match ($this) {
            self::Local => __('Local'),
            self::Takeaway => __('Takeaway'),
            self::Delivery => __('Delivery'),
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::Local => 'warning',
            self::Takeaway => 'success',
            self::Delivery => 'success',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Local => 'heroicon-m-arrow-path',
            self::Takeaway => 'heroicon-m-arrow-path',
            self::Delivery => 'heroicon-m-arrow-path',
        };
    }
}
