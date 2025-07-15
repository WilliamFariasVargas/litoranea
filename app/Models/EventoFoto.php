<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventoFoto extends Model
{
    protected $fillable = ['evento_id', 'imagem'];

    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }
}
