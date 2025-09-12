<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Narudzbina;

class NarudzbinaSeeder extends Seeder
{
    public function run()
    {
        Narudzbina::create([
            'Specifikacija' => '/slike/proizvodi/slika_stola1',
            'Rok' => now()->addDays(30),
            'Klijent_id' => 1,
            'Stolar_id' => 1,
            'Cena' => 25000.00,
            'Status_id' => 1, // "Na čekanju"
        ]);

        Narudzbina::create([
            'Specifikacija' => 'Ormar sa ogledalom',
            'Rok' => now()->addDays(45),
            'Klijent_id' => 2,
            'Stolar_id' => 2,
            'Cena' => 40000.00,
            'Status_id' => 2, // "U izradi"
        ]);
    }
}
