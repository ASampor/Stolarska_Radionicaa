<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stolar extends Model
{
    protected $table = 'Stolar';
    protected $primaryKey = 'ID_Stolar';
    public $timestamps = false;

    protected $fillable = ['Ime', 'Prezime', 'Email', 'Lozinka', 'Telefon'];

    public function termini()
    {
        return $this->hasMany(Termin::class, 'Stolar_id', 'ID_Stolar');
    }

    public function narudzbine()
    {
        return $this->hasMany(Narudzbina::class, 'Stolar_id', 'ID_Stolar');
    }
}
