<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
Use App\Models\Zahtev;
Use App\Models\Klijent;
Use App\Models\Narudzbina;


class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users'; // ime tvoje tabele
    public $incrementing = true;
    // Ako je primarni ključ drugačiji od 'id', recimo 'ID_Klijent', promeni:
    protected $primaryKey = 'id'; // promeni u 'ID_Klijent' ako je potrebno

    protected $fillable = [
        'ime',
        'prezime',
        'email',
        'password',
        'role',
        'personal_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function klijent()
    {
        return $this->belongsTo(Klijent::class, 'person_id', 'ID_Klijent');
    }

    public function zahtevi()
    {
        return $this->hasMany(Zahtev::class, 'klijent_id');
    }

    // Relacija sa narudzbinama
    public function narudzbine()
    {
        return $this->hasMany(Narudzbina::class, 'klijent_id');
    }

    // User.php
    public function stolar()
    {
        return $this->hasOne(Stolar::class, 'Email', 'email');
    }

}

