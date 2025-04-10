<?php

namespace App\Http\Controllers;
use App\Models\Pedido;
use App\Models\PedidoItem;
use App\Models\Fornecedor;
use App\Models\Representada;
use App\Models\Cliente;
use App\Models\Transportadora;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PedidoController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::with('cliente')->orderByDesc('id')->get();
        return view('pedidos.index', compact('pedidos'));
    }

    public function create()
    {
        return view('pedidos.create', [
            'clientes' => Cliente::all(),
            'representadas' => Representada::all(),
            'fornecedores' => Fornecedor::all(),
            'transportadoras' => Transportadora::all(),
        ]);
    }

    public function store(Request $request)
    {
        $pedido = Pedido::create([
            'numero_pedido' => uniqid('PED'),
            'representada_id' => $request->representada_id,
            'cliente_id' => $request->cliente_id,
            'Fornecedor_id' => $request->Fornecedor_id,
            'transportadora_id' => $request->transportadora_id,
            'valor_total' => 0,
        ]);

        $totalGeral = 0;
        foreach ($request->itens as $item) {
            $total = $item['quantidade'] * $item['valor_unitario'];
            PedidoItem::create([
                'pedido_id' => $pedido->id,
                'item' => $item['item'],
                'codigo' => $item['codigo'],
                'descricao' => $item['descricao'],
                'quantidade' => $item['quantidade'],
                'valor_unitario' => $item['valor_unitario'],
                'valor_com_desconto' => $item['valor_com_desconto'] ?? $item['valor_unitario'],
                'total' => $total,
            ]);
            $totalGeral += $total;
        }

        $pedido->update(['valor_total' => $totalGeral]);

        return redirect()->route('pedidos.index')->with('success', 'Pedido criado com sucesso!');
    }

    public function imprimir(Pedido $pedido)
    {
        $pedido->load('itens', 'cliente', 'representada', 'Fornecedor', 'transportadora');
        return view('pedidos.imprimir', compact('pedido'));
    }

    public function gerarPdf(Pedido $pedido)
    {
        $pedido->load('itens', 'cliente', 'representada', 'Fornecedor', 'transportadora');
        $pdf = Pdf::loadView('pedidos.pdf', compact('pedido'));
        return $pdf->download("pedido-{$pedido->numero_pedido}.pdf");
    }
}
