<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Zahtev;

class ZahtevSeeder extends Seeder
{
    public function run()
    {
        Zahtev::create([
            'Vrsta_proizvoda' => 'Sto',
            'Opis' => 'Drveni sto od hrastovine, dimenzije 120x80',
            'Datum_kreiranja' => now(),
            'Lokacija' => 'Beograd, Cara Dušana 15',
            'Telefon' => '061123456',
            'Klijent_id' => 1, // povezan sa Petrom
        ]);

        Zahtev::create([
            'Vrsta_proizvoda' => 'Ormar',
            'Opis' => 'Ugradni ormar sa kliznim vratima',
            'Datum_kreiranja' => now(),
            'Lokacija' => 'Novi Sad, Bulevar 22',
            'Telefon' => '062654321',
            'Klijent_id' => 2, // povezan sa Anom
        ]);
    }
}
