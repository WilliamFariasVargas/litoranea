<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CadastroDePedido extends Model
{
    use HasFactory;

    protected $table = 'cadastrodepedido'; // <- importante mudar aqui!

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

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function representada()
    {
        return $this->belongsTo(Representada::class);
    }

    public function transportadora()
    {
        return $this->belongsTo(Transportadora::class);
    }


}
