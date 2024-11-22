<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        rescue(fn () => $this->migrator->add('customization.terms'));
        rescue(fn () => $this->migrator->add('customization.policy'));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
