<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Termin;

class TerminSeeder extends Seeder
{
    public function run()
    {
        Termin::create([
            'Datum_vreme' => now()->addDays(3),
            'Zahtev_id' => 1,  // povezan sa prvim zahtevom
            'Stolar_id' => 1,  // stolar Marko
        ]);

        Termin::create([
            'Datum_vreme' => now()->addDays(5),
            'Zahtev_id' => 2,  // povezan sa drugim zahtevom
            'Stolar_id' => 2,  // stolar Jovan
        ]);
    }
}
