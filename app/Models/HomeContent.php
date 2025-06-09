<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeContent extends Model
{
    protected $fillable = [
        'logo',
        'foto_sobre',
        'clientes',
        'anos_experiencia',
        'parceiros',
        'eventos',
        'estados',
        'texto_sobre',
        'whatsapp',
    ];
}
