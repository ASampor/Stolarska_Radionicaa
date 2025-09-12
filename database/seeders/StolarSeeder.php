<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Stolar;
use Illuminate\Support\Facades\Hash;

class StolarSeeder extends Seeder
{
    public function run()
    {
        Stolar::create([
            'Ime' => 'Marko',
            'Prezime' => 'Ristić ',
            'Email' => 'mmarko@gmail.com',
            'Lozinka' => Hash::make('stolar123'),
            'Telefon' => '0626830404',
            
        ]);

        Stolar::create([
            'Ime' => 'Jovan',
            'Prezime' => 'Marković',
            'Email' => 'jovan@gmail.com',
            'Lozinka' => Hash::make('stolar567'),
            'Telefon' => '0625643894',
        ]);
    }
}
