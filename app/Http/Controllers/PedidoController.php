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

        // Representada
        $msg .= "*Representada:* " . ($pedido->representada->razao_social ?? $pedido->representada->nome ?? '-') . "\n\n";

        // Representante (Fornecedor)
        $msg .= "*Representante:* " . ($pedido->fornecedor->razao_social ?? $pedido->fornecedor->nome ?? '-') . "\n";
        $msg .= "*Email:* " . ($pedido->fornecedor->email ?? 'Não informado') . "\n";
        $msg .= "*Telefone:* " . ($pedido->fornecedor->fone ?? 'Não informado') . "\n\n";

        // Cliente
        $cliente = $pedido->cliente;
        $msg .= "*Cliente:* " . ($cliente->razao_social ?? $cliente->nome ?? '-') . "\n";
        $msg .= "*Endereço:* " . ($cliente->rua ?? 'Não informado') . "\n";
        $msg .= "*Cidade:* " . ($cliente->cidade ?? 'Não informado') . " / " . ($cliente->uf ?? '-') . "\n";
        $msg .= "*CEP:* " . ($cliente->cep ?? 'Não informado') . "\n";
        $msg .= "*Celular:* " . ($cliente->celular ?? 'Não informado') . "\n";
        $msg .= "*Email:* " . ($cliente->email ?? 'Não informado') . "\n";
        $msg .= "*CPF/CNPJ:* " . ($cliente->cpf_cnpj ?? 'Não informado') . "\n\n";

        // Transportadora
        $msg .= "*Transportadora:* " . ($pedido->transportadora->razao_social ?? $pedido->transportadora->nome ?? '-') . "\n";
        $msg .= "*Telefone:* " . ($pedido->transportadora->celular ?? 'Não informado') . "\n";
        $msg .= "*Email:* " . ($pedido->transportadora->email ?? 'Não informado') . "\n\n";

        // Itens
        $msg .= "*Itens do Pedido:*\n";
        foreach ($pedido->itens as $index => $item) {
            $msg .= ($index + 1) . ") {$item->descricao} (Cod: {$item->codigo})\n";
            $msg .= "Quantidade: {$item->quantidade} un\n";
            $msg .= "Valor Unitário: R$ " . number_format($item->valor_unitario, 2, ',', '.') . "\n";
            $msg .= "Desconto: R$ " . number_format($item->valor_com_desconto ?? $item->valor_unitario, 2, ',', '.') . "\n";
            $msg .= "Total: R$ " . number_format($item->total, 2, ',', '.') . "\n\n";
        }

        // Total Geral
        $msg .= "*Total Geral:* R$ " . number_format($pedido->valor_total, 2, ',', '.');

        // Redireciona para WhatsApp com mensagem codificada
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
        'fornecedores_id'   => $request->fornecedor_id,
        'transportadora_id' => $request->transportadora_id,
        'data_pedido'       => $request->data_pedido,
        'data_faturamento'  => $request->data_faturamento,
        'valor_pedido'      => floatval($request->valor_pedido),
        'valor_faturado'    => floatval($request->valor_faturado),
        'indice_comissao'   => floatval($request->indice_comissao),
        'valor_comissao_parcial' => floatval($request->valor_comissao_parcial),
        'valor_comissao_faturada' => floatval($request->valor_comissao_faturada),
        'valor_total'       => 0,
    ]);

    $totalGeral = 0;

    if (is_array($request->itens)) {
        foreach ($request->itens as $item) {
            $valorUnitario = floatval($item['valor_unitario']);
            $valorDesconto = isset($item['valor_com_desconto']) ? floatval($item['valor_com_desconto']) : $valorUnitario;

            $total = $item['quantidade'] * $valorUnitario;

            PedidoItem::create([
                'pedido_id'           => $pedido->id,
                'item'                => $item['item'],
                'codigo'              => $item['codigo'],
                'descricao'           => $item['descricao'],
                'quantidade'          => $item['quantidade'],
                'valor_unitario'      => $valorUnitario,
                'valor_com_desconto'  => $valorDesconto,
                'total'               => $total,
            ]);

            $totalGeral += $total;
        }
    }

    $pedido->update(['valor_total' => $totalGeral]);

    return response()->json(['message' => 'Pedido criado com sucesso!']);
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

