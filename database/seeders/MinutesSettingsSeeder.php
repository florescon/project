<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class MinutesSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->updateOrInsert(
            [
                'group' => 'app', // El nombre de tu grupo de configuraciones
                'name' => 'minutes',
            ],
            [
                'payload' => '40',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
