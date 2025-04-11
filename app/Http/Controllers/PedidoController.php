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



    public function whatsapp(Pedido $pedido)
{
    $pedido->load(['cliente', 'representada', 'fornecedor', 'transportadora', 'itens']);

    $msg = "*Pedido Nº {$pedido->numero_pedido}*\n\n";

    $msg .= "*Cliente:* " . ($pedido->cliente->razao_social ?? $pedido->cliente->nome ?? '-') . "\n";
    $msg .= "*Representada:* " . ($pedido->representada->razao_social ?? $pedido->representada->nome ?? '-') . "\n";
    $msg .= "*Fornecedor:* " . ($pedido->fornecedor->razao_social ?? $pedido->fornecedor->nome ?? '-') . "\n";
    $msg .= "*Transportadora:* " . ($pedido->transportadora->razao_social ?? $pedido->transportadora->nome ?? '-') . "\n\n";

    $msg .= "*Itens do Pedido:*\n";

    foreach ($pedido->itens as $index => $item) {
        $numero = $index + 1;
        $msg .= "{$numero}) {$item->descricao} (Cod: {$item->codigo})\n";
        $msg .= "   Quantidade: {$item->quantidade} un\n";
        $msg .= "   Unitário: R$ " . number_format($item->valor_unitario, 2, ',', '.') . "\n";
        $msg .= "   Desconto: R$ " . number_format($item->valor_com_desconto ?? 0, 2, ',', '.') . "\n";
        $msg .= "   Total: R$ " . number_format($item->total, 2, ',', '.') . "\n\n";
    }

    $msg .= "*Total Geral:* R$ " . number_format($pedido->valor_total, 2, ',', '.');

    $url = 'https://wa.me/?text=' . rawurlencode($msg);
    return redirect()->away($url);
}







    public function index()
    {
        $pedidos = Pedido::with('cliente')->orderByDesc('id')->get();
        return view('pedidos.index', compact('pedidos'));
    }

    public function create()
{
    $representadas   = Representada::all();
    $clientes        = Cliente::all();
    $fornecedores    = Fornecedor::all(); // <- precisa estar assim
    $transportadoras = Transportadora::all();

    return view('pedidos.create', compact(
        'representadas',
        'clientes',
        'fornecedores',
        'transportadoras'
    ));
}

    public function store(Request $request)
    {
        $pedido = Pedido::create([
            'numero_pedido'     => uniqid('PED'),
            'representada_id'   => $request->representada_id,
            'cliente_id'        => $request->cliente_id,
            'fornecedores_id'     => $request->fornecedor_id,
            'transportadora_id' => $request->transportadora_id,
            'valor_total'       => 0,
        ]);

        $totalGeral = 0;




        foreach ($request->itens as $item) {
            $total = $item['quantidade'] * $item['valor_unitario'];
            PedidoItem::create([
                'pedido_id'           => $pedido->id,
                'item'                => $item['item'],
                'codigo'              => $item['codigo'],
                'descricao'           => $item['descricao'],
                'quantidade'          => $item['quantidade'],
                'valor_unitario'      => $item['valor_unitario'],
                'valor_com_desconto'  => $item['valor_com_desconto'] ?? $item['valor_unitario'],
                'total'               => $total,
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
        $pedido->load('representada', 'cliente', 'fornecedor', 'transportadora', 'representante', 'itens');
        $pdf = Pdf::loadView('pedidos.pdf', compact('pedido'));
        return $pdf->download("pedido-{$pedido->numero_pedido}.pdf");
    }
    public function destroy(Pedido $pedido)
    {
        $pedido->delete();
        return redirect()->route('pedidos.index')->with('success', 'Pedido excluído com sucesso.');
    }

}

