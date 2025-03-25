<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        // only add these two lines to the boot() function on the AppServiceProvider class
        \Filament\Resources\Pages\CreateRecord::disableCreateAnother();
    }
}
