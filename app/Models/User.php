<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
Use App\Models\Zahtev;
Use App\Models\Klijent;
Use App\Models\Narudzbina;


class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    protected $table = 'users'; 
    public $incrementing = true;
    protected $primaryKey = 'id'; 


    protected $fillable = [
        'ime',
        'prezime',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];


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

