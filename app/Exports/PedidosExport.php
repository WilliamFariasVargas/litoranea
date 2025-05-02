<?php

namespace App\Exports;

use App\Models\CadastroDePedido;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;

class PedidosExport implements FromCollection, WithHeadings
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $query = CadastroDePedido::with(['cliente', 'representada', 'transportadora']);

        if ($this->request->cliente_id) {
            $query->where('cliente_id', $this->request->cliente_id);
        }
        if ($this->request->representada_id) {
            $query->where('representada_id', $this->request->representada_id);
        }
        if ($this->request->transportadora_id) {
            $query->where('transportadora_id', $this->request->transportadora_id);
        }
        if ($this->request->mes) {
            $query->whereMonth('data_pedido', $this->request->mes);
        }
        if ($this->request->ano) {
            $query->whereYear('data_pedido', $this->request->ano);
        }

                // Fazendo JOIN com as tabelas relacionadas
        $query->join('clientes', 'clientes.id', '=', 'cadastrodepedido.cliente_id');
        $query->join('representadas', 'representadas.id', '=', 'cadastrodepedido.representada_id');
        $query->join('transportadoras', 'transportadoras.id', '=', 'cadastrodepedido.transportadora_id');

        // Agora busca os campos corretos, renomeando para cliente, representada e transportadora
        return $query->get([
            'clientes.razao_social as cliente',
            'representadas.razao_social as representada',
            'transportadoras.razao_social as transportadora',
            'data_pedido',
            'valor_pedido',
            'valor_faturado',
            'valor_comissao_parcial',
            'valor_comissao_faturada',
        ]);
    }

    public function headings(): array
    {
        return [
            'Cliente',
            'Representada',
            'Transportadora',
            'Data do Pedido',
            'Valor Pedido',
            'Valor Faturado',
            'Valor Comissão Parcial',
            'Valor Comissão Faturada',
        ];
    }
}
