<?php

namespace App\Exports;

use App\Models\CadastroDePedido;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;

class PedidosExport implements FromQuery, WithHeadings
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function query()
    {
        $query = CadastroDePedido::with(['cliente', 'representada', 'transportadora']);

        if ($this->request->filled('cliente_id')) {
            $query->where('cliente_id', $this->request->cliente_id);
        }
        if ($this->request->filled('representada_id')) {
            $query->where('representada_id', $this->request->representada_id);
        }
        if ($this->request->filled('transportadora_id')) {
            $query->where('transportadora_id', $this->request->transportadora_id);
        }
        if ($this->request->filled('data_inicial') && $this->request->filled('data_final')) {
            $query->whereBetween('data_pedido', [$this->request->data_inicial, $this->request->data_final]);
        } else {
            if ($this->request->filled('mes')) {
                $query->whereMonth('data_pedido', $this->request->mes);
            }
            if ($this->request->filled('ano')) {
                $query->whereYear('data_pedido', $this->request->ano);
            }
        }
        if ($this->request->filled('status')) {
            if ($this->request->status === 'pendente') {
                $query->whereBetween('valor_faturado', [0, 1]);
            } elseif ($this->request->status === 'baixado') {
                $query->where('valor_faturado', '>', 1);
            }
        }

        return $query;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Data do Pedido',
            'Cliente',
            'Representada',
            'Transportadora',
            'Valor Pedido',
            'Valor Faturado',
            'Data Faturamento',
            'Comissão Parcial',
            'Comissão Faturada',
            // adicione outras colunas que quiser exportar
        ];
    }
}
