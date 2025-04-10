<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PedidoItem extends Model
{
    protected $fillable = [
        'pedido_id', 'item', 'codigo', 'descricao',
        'quantidade', 'valor_unitario', 'valor_com_desconto', 'total'
    ];

    public function pedido() {
        return $this->belongsTo(Pedido::class);
    }
}
