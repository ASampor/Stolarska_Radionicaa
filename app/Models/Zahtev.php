<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zahtev extends Model
{
    protected $table = 'zahtevi';   // tačno ime tabele
    protected $primaryKey = 'id';   // primarni ključ je 'id'
    public $timestamps = true;

    protected $fillable = [
        'Vrsta_proizvoda',
        'Opis',
        'Lokacija',
        'Telefon',
        'Klijent_id',
    ];

    public function klijent()
    {
        return $this->belongsTo(Klijent::class, 'Klijent_id', 'ID_Klijent');
    }
}
