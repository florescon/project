<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        rescue(fn () => $this->migrator->add('app.minutes', '40'));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
