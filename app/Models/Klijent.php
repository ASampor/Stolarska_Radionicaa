<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Klijent extends Model
{
    use HasFactory;
    protected $table = 'Klijent';
    protected $primaryKey = 'ID_Klijent';
    public $timestamps = false;

    protected $fillable = ['Ime', 'Prezime', 'Email', 'Lozinka'];

    public function zahtevi()
    {
        return $this->hasMany(Zahtev::class, 'Klijent_id', 'ID_Klijent');
    }

    public function narudzbine()
    {
        return $this->hasMany(Narudzbina::class, 'Klijent_id', 'ID_Klijent');
    }
}
