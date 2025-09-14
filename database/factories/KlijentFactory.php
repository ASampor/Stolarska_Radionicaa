<?php

namespace Database\Factories;

use App\Models\Klijent;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class KlijentFactory extends Factory
{
    protected $model = Klijent::class;

    public function definition()
    {
        return [
            'Ime' => $this->faker->firstName(),
            'Prezime' => $this->faker->lastName(),
            'Email' => $this->faker->unique()->safeEmail(),
            'Lozinka' => bcrypt('password'), // default lozinka za test
        ];
    }
}
