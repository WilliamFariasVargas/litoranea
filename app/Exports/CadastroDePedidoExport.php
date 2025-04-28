<?php

namespace App\Exports;

use App\Models\CadastroDePedido;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;

class CadastroDePedidoExport implements FromCollection, WithHeadings
{
    protected $filters;

    public function __construct(Request $filters)
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = CadastroDePedido::with(['cliente', 'representada', 'transportadora']);

        if ($this->filters->cliente_id) {
            $query->where('cliente_id', $this->filters->cliente_id);
        }

        if ($this->filters->representada_id) {
            $query->where('representada_id', $this->filters->representada_id);
        }

        if ($this->filters->transportadora_id) {
            $query->where('transportadora_id', $this->filters->transportadora_id);
        }

        if ($this->filters->mes) {
            $query->whereMonth('data_pedido', $this->filters->mes);
        }

        if ($this->filters->ano) {
            $query->whereYear('data_pedido', $this->filters->ano);
        }

        return $query->get()->map(function($pedido){
            return [
                'Cliente' => $pedido->cliente->razao_social ?? '',
                'Representada' => $pedido->representada->nome ?? '',
                'Transportadora' => $pedido->transportadora->nome ?? '',
                'Valor Pedido' => $pedido->valor_pedido,
                'Valor Faturado' => $pedido->valor_faturado,
                'Data Pedido' => optional($pedido->data_pedido)->format('d/m/Y'),
                'Data Faturamento' => optional($pedido->data_faturamento)->format('d/m/Y'),
                'Valor Comissão Parcial' => $pedido->valor_comissao_parcial,
                'Valor Comissão Faturada' => $pedido->valor_comissao_faturada,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Cliente',
            'Representada',
            'Transportadora',
            'Valor Pedido',
            'Valor Faturado',
            'Data Pedido',
            'Data Faturamento',
            'Valor Comissão Parcial',
            'Valor Comissão Faturada',
        ];
    }
}
