<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // pozivamo naše seedere redosledom koji prati logiku procesa
        $this->call([
            StatusSeeder::class,
            KlijentSeeder::class,
            StolarSeeder::class,
            ZahtevSeeder::class,
            TerminSeeder::class,
            NarudzbinaSeeder::class,
        ]);
    }
}
