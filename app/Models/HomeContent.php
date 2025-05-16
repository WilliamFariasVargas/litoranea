<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeContent extends Model
{
    protected $fillable = [
        'logo',
        'clientes',
        'anos_experiencia',
        'parceiros',
        'estados_atendidos',
        'sobre',
        'foto_sobre',
        'whatsapp',
    ];
}

