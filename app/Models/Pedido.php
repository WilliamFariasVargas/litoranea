<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pedido extends Model
{
    protected $fillable = [
        'data_pedido',
        'cliente_id',
        'representada_id',
        'transportadora_id',
        'valor_pedido',
        'valor_faturado',
        'indice_comissao', // ✅ este precisa estar aqui
        'data_faturamento',
        'valor_comissao_parcial',
        'valor_comissao_faturada'
        ];


    public function itens() {
        return $this->hasMany(PedidoItem::class);
    }

    public function cliente() {
        return $this->belongsTo(Cliente::class);
    }
    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class, 'fornecedores_id');
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
