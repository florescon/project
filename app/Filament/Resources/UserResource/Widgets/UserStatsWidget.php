<?php

namespace App\Filament\Resources\UserResource\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UserStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Clientes', User::where('role', User::ROLE_USER)->count()),
            Stat::make('Total Administradores', User::where('role', User::ROLE_ADMIN)->count()),
            Stat::make('Total Recepción', User::where('role', User::ROLE_EDITOR)->count()),
        ];
    }
}
