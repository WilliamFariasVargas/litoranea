<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comissao extends Model
{
    protected $table = 'comissoes';

    protected $fillable = [
        'pedido_id', 'percentual', 'valor', 'valor_calculado'
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }
}

