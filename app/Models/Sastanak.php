<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sastanak extends Model
{
    protected $table = 'sastanak';
    protected $primaryKey = 'ID_Sastanak';
    public $timestamps = true;

    protected $fillable = ['Datum_vreme', 'Zahtev_id', 'Stolar_id'];

    public function zahtev()
    {
        return $this->belongsTo(Zahtev::class, 'Zahtev_id', 'id');
    }

    public function stolar()
    {
        return $this->belongsTo(Stolar::class, 'Stolar_id', 'ID_Stolar');
    }
}
