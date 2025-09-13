<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zahtev extends Model
{
    protected $table = 'Zahtevi';
    protected $primaryKey = 'ID_Zahtev';
    public $timestamps = true;

    protected $fillable = [
        'Vrsta_proizvoda',
        'Opis',
        'Datum_kreiranja',
        'Lokacija',
        'Telefon',
        'Klijent_id'
    ];

    protected $dates = ['created_at', 'updated_at'];

    public function klijent()
    {
        return $this->belongsTo(Klijent::class, 'Klijent_id', 'ID_Klijent');
    }

    public function termin()
    {
        return $this->hasOne(Termin::class, 'Zahtev_id', 'ID_Zahtev');
    }

    
}
