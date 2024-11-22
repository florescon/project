<?php

namespace App\Src\Settings;

use Spatie\LaravelSettings\Settings;

class CustomizationSettings extends Settings
{
    public ?string $header;

    public ?string $footer;

    public ?string $stylesheet;

    public ?string $terms;

    public ?string $policy;

    public static function group(): string
    {
        return 'customization';
    }
}
