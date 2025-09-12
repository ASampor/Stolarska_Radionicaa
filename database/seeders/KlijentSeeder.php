<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Klijent;
use Illuminate\Support\Facades\Hash;

class KlijentSeeder extends Seeder
{
    public function run()
    {
        Klijent::create([
            'Ime' => 'Petar',
            'Prezime' => 'Petrović',
            'Email' => 'petar@gmail.com',
            'Lozinka' => Hash::make('lozinka123'),
        ]);

        Klijent::create([
            'Ime' => 'Ana',
            'Prezime' => 'Anić',
            'Email' => 'ana@gmail.com',
            'Lozinka' => Hash::make('lozinka123'),
        ]);
    }
}
