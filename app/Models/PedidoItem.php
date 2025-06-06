<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoItem extends Model
{
    use HasFactory;

    protected $table = 'pedido_itens';

    protected $fillable = [
        'pedido_id',
        'item',
        'codigo',
        'descricao',
        'quantidade',
        'valor_unitario',
        'valor_com_desconto',
        'total'
    ];
}

