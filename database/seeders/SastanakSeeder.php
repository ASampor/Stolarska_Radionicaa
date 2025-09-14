<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sastanak;

class SastanakSeeder extends Seeder
{
    public function run()
    {
        Sastanak::create([
            'Datum_vreme' => now()->addDays(3),
            'Zahtev_id' => 1,  // povezan sa prvim zahtevom
            'Stolar_id' => 1,  // stolar Marko
        ]);

        Sastanak::create([
            'Datum_vreme' => now()->addDays(5),
            'Zahtev_id' => 2,  // povezan sa drugim zahtevom
            'Stolar_id' => 2,  // stolar Jovan
        ]);
    }
}
