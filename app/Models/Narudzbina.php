<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Narudzbina extends Model
{
    protected $table = 'Narudzbina';
    protected $primaryKey = 'ID_Narudzbina';
    public $timestamps = false;

    protected $fillable = [
        'Specifikacija', 'Rok', 'Klijent_id', 'Stolar_id', 'Status_id', 'Vrsta_proizvoda', 'Cena'
    ];

    // Relacija sa klijentom
    public function klijent()
    {
        return $this->belongsTo(Klijent::class, 'Klijent_id', 'ID_Klijent');
    }

    // Relacija sa stolarom
    public function stolar()
    {
        return $this->belongsTo(Stolar::class, 'Stolar_id', 'ID_Stolar');
    }

    // Relacija sa statusom
    public function status()
    {
        return $this->belongsTo(Status::class, 'Status_id', 'ID_Status');
    }
}
