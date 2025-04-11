<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pedido extends Model
{
    protected $fillable = [
        'numero_pedido',
        'representada_id',
        'cliente_id',
        'fornecedores_id',
        'transportadora_id',
        'valor_total',
    ];


    public function itens() {
        return $this->hasMany(PedidoItem::class);
    }

    public function cliente() {
        return $this->belongsTo(Cliente::class);
    }

    public function fornecedor() {
        return $this->belongsTo(Fornecedor::class);
    }

    public function representada() {
        return $this->belongsTo(Representada::class);
    }

    public function transportadora() {
        return $this->belongsTo(Transportadora::class);
    }
    public function representante() {
        return $this->belongsTo(User::class, 'representante_id');
    }

}
