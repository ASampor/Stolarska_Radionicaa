<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Termin extends Model
{
    protected $table = 'Termin';
    protected $primaryKey = 'ID_Termin';
    public $timestamps = false;

    protected $fillable = ['Datum_vreme', 'Zahtev_id', 'Stolar_id'];

    public function zahtev()
    {
        return $this->belongsTo(Zahtev::class, 'Zahtev_id', 'ID_Zahtev');
    }

    public function stolar()
    {
        return $this->belongsTo(Stolar::class, 'Stolar_id', 'ID_Stolar');
    }
}
