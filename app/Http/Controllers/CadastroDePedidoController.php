<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CadastroDePedido;
use App\Models\Cliente;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PedidosExport;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class CadastroDePedidoController extends Controller
{
    public function index(Request $request)
    {
        $query = CadastroDePedido::with(['cliente', 'representada', 'transportadora']);

        if ($request->cliente_id) {
            $query->where('cliente_id', $request->cliente_id);
        }
        if ($request->representada_id) {
            $query->where('representada_id', $request->representada_id);
        }
        if ($request->transportadora_id) {
            $query->where('transportadora_id', $request->transportadora_id);
        }

        if ($request->filled('data_inicial') && $request->filled('data_final')) {
            $query->whereBetween('data_pedido', [$request->data_inicial, $request->data_final]);
        } else {
            if ($request->mes) {
                $query->whereMonth('data_pedido', $request->mes);
            }
            if ($request->ano) {
                $query->whereYear('data_pedido', $request->ano);
            }
        }
        if ($request->filled('status')) {
            if ($request->status === 'pendente') {
                $query->whereBetween('valor_faturado', [0, 1]);
            } elseif ($request->status === 'baixado') {
                $query->where('valor_faturado', '>', 1);
            }
        }

        // Ordenação
       $allowedOrders = ['data_pedido', 'valor_pedido', 'valor_faturado', 'cliente_id'];
$orderBy = $request->get('order', 'data_pedido');
$dir = strtolower($request->get('dir', 'desc')) === 'asc' ? 'asc' : 'desc';

if (!in_array($orderBy, $allowedOrders)) {
    $orderBy = 'data_pedido';
}

if ($orderBy === 'cliente_id') {
    $query->join('clientes', 'cadastrodepedido.cliente_id', '=', 'clientes.id')
          ->orderBy('clientes.razao_social', $dir)
          ->addSelect('cadastrodepedido.*');
} else {
    $query->orderBy($orderBy, $dir);
}

        $pedidos = $query->get();

        $valor_total = $pedidos->sum('valor_pedido');
        $valor_total_faturado = $pedidos->sum('valor_faturado');
        $valor_total_comissao_parcial = $pedidos->sum('valor_comissao_parcial');
        $valor_total_comissao_faturada = $pedidos->sum('valor_comissao_faturada');

        return view('cadastrodepedido.index', compact(
            'pedidos',
            'valor_total',
            'valor_total_faturado',
            'valor_total_comissao_parcial',
            'valor_total_comissao_faturada'
        ));
    }

    public function create()
    {
        return view('cadastrodepedido.create');
    }

    public function store(Request $request)
    {
        CadastroDePedido::create([
            'data_pedido'               => $request->data_pedido,
            'cliente_id'                => $request->cliente_id,
            'representada_id'           => $request->representada_id,
            'transportadora_id'         => $request->transportadora_id,
            'valor_pedido'              => (float) $request->valor_pedido,
            'valor_faturado'            => (float) $request->valor_faturado,
            'data_faturamento'          => $request->data_faturamento,
            'valor_comissao_parcial'    => (float) $request->valor_comissao_parcial,
            'valor_comissao_faturada'   => (float) $request->valor_comissao_faturada,
            'indice_comissao'           => (float) $request->indice_comissao,
        ]);

        return response()->json(['message' => 'Pedido cadastrado com sucesso!']);
    }

    public function edit($id)
    {
        $pedido = CadastroDePedido::with(['cliente', 'representada', 'transportadora'])->findOrFail($id);
        return view('cadastrodepedido.edit', compact('pedido'));
    }

    public function update(Request $request, $id)
    {
        try {
            $pedido = CadastroDePedido::findOrFail($id);

            $convertDecimal = function ($value) {
                if (is_null($value)) return null;
                return str_replace(',', '.', str_replace('.', '', $value));
            };

            $pedido->update([
                'data_pedido'               => $request->data_pedido,
                'cliente_id'                => $request->cliente_id,
                'representada_id'           => $request->representada_id,
                'transportadora_id'         => $request->transportadora_id,
                'valor_pedido'              => (float) $request->valor_pedido,
                'valor_faturado'            => (float) $request->valor_faturado,
                'data_faturamento'          => $request->data_faturamento,
                'valor_comissao_parcial'    => (float) $request->valor_comissao_parcial,
                'valor_comissao_faturada'   => (float) $request->valor_comissao_faturada,
                'indice_comissao'           => (float) $request->indice_comissao,
            ]);

            return response()->json(['message' => 'Pedido atualizado com sucesso!']);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao atualizar',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        $pedido = CadastroDePedido::findOrFail($id);
        $pedido->delete();

        return response()->json(['message' => 'Pedido excluído com sucesso!']);
    }

    public function show(Request $request)
    {
        $query = CadastroDePedido::with(['cliente', 'representada', 'transportadora']);

        if ($request->cliente_id) {
            $query->where('cliente_id', $request->cliente_id);
        }
        if ($request->representada_id) {
            $query->where('representada_id', $request->representada_id);
        }
        if ($request->transportadora_id) {
            $query->where('transportadora_id', $request->transportadora_id);
        }

        if ($request->filled('data_inicial') && $request->filled('data_final')) {
            $query->whereBetween('data_pedido', [$request->data_inicial, $request->data_final]);
        } else {
            if ($request->mes) {
                $query->whereMonth('data_pedido', $request->mes);
            }
            if ($request->ano) {
                $query->whereYear('data_pedido', $request->ano);
            }
        }
        if ($request->filled('status')) {
            if ($request->status === 'pendente') {
                $query->whereBetween('valor_faturado', [0, 1]);
            } elseif ($request->status === 'baixado') {
                $query->where('valor_faturado', '>', 1);
            }
        }

        $allowedOrders = ['data_pedido', 'valor_pedido', 'valor_faturado', 'cliente_id'];
$orderBy = $request->get('order', 'data_pedido');
$dir = strtolower($request->get('dir', 'desc')) === 'asc' ? 'asc' : 'desc';

if (!in_array($orderBy, $allowedOrders)) {
    $orderBy = 'data_pedido';
}

if ($orderBy === 'cliente_id') {
    $query->join('clientes', 'cadastrodepedido.cliente_id', '=', 'clientes.id')
          ->orderBy('clientes.razao_social', $dir)
          ->addSelect('cadastrodepedido.*');
} else {
    $query->orderBy($orderBy, $dir);
}

        $pedidos = $query->get();

        $valor_total = $pedidos->sum('valor_pedido');
        $valor_total_faturado = $pedidos->sum('valor_faturado');
        $valor_total_comissao_parcial = $pedidos->sum('valor_comissao_parcial');
        $valor_total_comissao_faturada = $pedidos->sum('valor_comissao_faturada');

        return view('cadastrodepedido.table', compact(
            'pedidos',
            'valor_total',
            'valor_total_faturado',
            'valor_total_comissao_parcial',
            'valor_total_comissao_faturada',
            'orderBy',
            'dir'
        ));
    }

    public function search(Request $request)
    {
        $term = $request->get('q', '');
        $results = Cliente::select('id', 'razao_social')
            ->where('razao_social', 'like', "%{$term}%")
            ->limit(20)
            ->get();

        return response()->json($results);
    }

    public function showTabela(Request $request)
    {
        return $this->show($request);
    }

    public function exportPdf(Request $request)
    {
        $query = CadastroDePedido::with(['cliente', 'representada', 'transportadora']);

        if ($request->filled('cliente_id')) {
            $query->where('cliente_id', $request->cliente_id);
        }
        if ($request->filled('representada_id')) {
            $query->where('representada_id', $request->representada_id);
        }
        if ($request->filled('transportadora_id')) {
            $query->where('transportadora_id', $request->transportadora_id);
        }

        if ($request->filled('data_inicial') && $request->filled('data_final')) {
            $query->whereBetween('data_pedido', [$request->data_inicial, $request->data_final]);
        } else {
            if ($request->filled('mes')) {
                $query->whereMonth('data_pedido', $request->mes);
            }
            if ($request->filled('ano')) {
                $query->whereYear('data_pedido', $request->ano);
            }
        }
        if ($request->filled('status')) {
            if ($request->status === 'pendente') {
                $query->whereBetween('valor_faturado', [0, 1]);
            } elseif ($request->status === 'baixado') {
                $query->where('valor_faturado', '>', 1);
            }
        }

        $allowedOrders = ['data_pedido', 'valor_pedido', 'valor_faturado', 'cliente_id'];
$orderBy = $request->get('order', 'data_pedido');
$dir = strtolower($request->get('dir', 'desc')) === 'asc' ? 'asc' : 'desc';

if (!in_array($orderBy, $allowedOrders)) {
    $orderBy = 'data_pedido';
}

if ($orderBy === 'cliente_id') {
    $query->join('clientes', 'cadastrodepedido.cliente_id', '=', 'clientes.id')
          ->orderBy('clientes.razao_social', $dir)
          ->addSelect('cadastrodepedido.*');
} else {
    $query->orderBy($orderBy, $dir);
}

        $pedidos = $query->get();

        $total_pedidos = $pedidos->sum('valor_pedido');
        $total_faturado = $pedidos->sum('valor_faturado');
        $total_comissao_parcial = $pedidos->sum('valor_comissao_parcial');
        $total_comissao_faturada = $pedidos->sum('valor_comissao_faturada');

        $cliente = $request->filled('cliente_id') ? Cliente::find($request->cliente_id) : null;
        $representada = $request->filled('representada_id') ? \App\Models\Representada::find($request->representada_id) : null;
        $transportadora = $request->filled('transportadora_id') ? \App\Models\Transportadora::find($request->transportadora_id) : null;
        $mes = $request->mes;
        $ano = $request->ano;
        $data_inicial = $request->data_inicial;
        $data_final = $request->data_final;

        $pdf = PDF::loadView('cadastrodepedido.relatorios.pdf', compact(
            'pedidos',
            'total_pedidos',
            'total_faturado',
            'total_comissao_parcial',
            'total_comissao_faturada',
            'cliente',
            'representada',
            'transportadora',
            'mes',
            'ano',
            'data_inicial',
            'data_final'
        ));

        return $pdf->download('relatorio_pedidos.pdf');
    }

    public function exportExcel(Request $request)
    {
        return Excel::download(new PedidosExport($request), 'pedidos.xlsx');
    }

    public function dashboard(Request $request)
    {
        $graficoQuery = CadastroDePedido::query();

        if ($request->filled('data_inicial') && $request->filled('data_final')) {
            $graficoQuery->whereBetween('data_pedido', [$request->data_inicial, $request->data_final]);
        } else {
            if ($request->mes) {
                $graficoQuery->whereMonth('data_pedido', $request->mes);
            }
            if ($request->ano) {
                $graficoQuery->whereYear('data_pedido', $request->ano);
            }
        }

        if ($request->filled('status')) {
            if ($request->status === 'pendente') {
                $graficoQuery->whereBetween('valor_faturado', [0, 1]);
            } elseif ($request->status === 'baixado') {
                $graficoQuery->where('valor_faturado', '>', 1);
            }
        }

        if ($request->cliente_id) {
            $graficoQuery->where('cliente_id', $request->cliente_id);
        }
        if ($request->representada_id) {
            $graficoQuery->where('representada_id', $request->representada_id);
        }
        if ($request->transportadora_id) {
            $graficoQuery->where('transportadora_id', $request->transportadora_id);
        }

        $pedidosAgrupados = $graficoQuery->selectRaw('YEAR(data_pedido) as ano, MONTH(data_pedido) as mes,
                                 SUM(valor_pedido) as total_pedido,
                                 SUM(valor_faturado) as total_faturado')
                                 ->groupByRaw('YEAR(data_pedido), MONTH(data_pedido)')
                                 ->orderByRaw('YEAR(data_pedido), MONTH(data_pedido)')
                                 ->get();

        $labels = [];
        $valoresPedidos = [];
        $valoresFaturados = [];

        foreach ($pedidosAgrupados as $pedido) {
            $labels[] = str_pad($pedido->mes, 2, '0', STR_PAD_LEFT) . '/' . $pedido->ano;
            $valoresPedidos[] = (float) $pedido->total_pedido;
            $valoresFaturados[] = (float) $pedido->total_faturado;
        }

        $totaisQuery = CadastroDePedido::query();

        if ($request->filled('data_inicial') && $request->filled('data_final')) {
            $totaisQuery->whereBetween('data_pedido', [$request->data_inicial, $request->data_final]);
        } else {
            if ($request->mes) {
                $totaisQuery->whereMonth('data_pedido', $request->mes);
            }
            if ($request->ano) {
                $totaisQuery->whereYear('data_pedido', $request->ano);
            }
        }

        if ($request->cliente_id) {
            $totaisQuery->where('cliente_id', $request->cliente_id);
        }
        if ($request->representada_id) {
            $totaisQuery->where('representada_id', $request->representada_id);
        }
        if ($request->transportadora_id) {
            $totaisQuery->where('transportadora_id', $request->transportadora_id);
        }
        if ($request->filled('status')) {
            if ($request->status === 'pendente') {
                $totaisQuery->whereBetween('valor_faturado', [0, 1]);
            } elseif ($request->status === 'baixado') {
                $totaisQuery->where('valor_faturado', '>', 1);
            }
        }

        $total_pedidos = $totaisQuery->sum('valor_pedido');
        $total_faturado = $totaisQuery->sum('valor_faturado');
        $total_comissao_parcial = $totaisQuery->sum('valor_comissao_parcial');
        $total_comissao_faturada = $totaisQuery->sum('valor_comissao_faturada');

        $clientes = Cliente::orderBy('razao_social')->get();
        $representadas = \App\Models\Representada::orderBy('razao_social')->get();
        $transportadoras = \App\Models\Transportadora::orderBy('razao_social')->get();

        return view('cadastrodepedido.dashboard', compact(
            'labels',
            'valoresPedidos',
            'valoresFaturados',
            'total_pedidos',
            'total_faturado',
            'total_comissao_parcial',
            'total_comissao_faturada',
            'clientes',
            'representadas',
            'transportadoras'
        ));
    }
}
