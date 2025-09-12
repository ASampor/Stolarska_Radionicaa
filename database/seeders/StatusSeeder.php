<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusSeeder extends Seeder
{
    public function run()
    {
        $statusi = ['Kreirana', 'U obradi', 'Završena', 'Otkazana', 'Spremna za isporuku', 'Isporučena i montirana', 'Plaćena' ];

        foreach ($statusi as $naziv) {
            Status::create(['Naziv' => $naziv]);
        }
    }
}
