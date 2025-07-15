<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $fillable = ['nome', 'local', 'mes', 'ano'];

    public function fotos()
    {
        return $this->hasMany(EventoFoto::class);
    }
}
