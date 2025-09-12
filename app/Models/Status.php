<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'Status';
    protected $primaryKey = 'ID_Status';
    public $timestamps = false;

    protected $fillable = ['Naziv'];

    public function narudzbine()
    {
        return $this->hasMany(Narudzbina::class, 'Status_id', 'ID_Status');
    }
}
