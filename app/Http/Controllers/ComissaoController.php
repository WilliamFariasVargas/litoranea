<?php

namespace App\Http\Controllers;
use App\Models\Pedido;
use App\Models\Comissao;
use Illuminate\Http\Request;

class ComissaoController extends Controller
{
    public function create()
    {
        $pedidos = Pedido::orderByDesc('created_at')->get();

        return view('comissoes.create', compact('pedidos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pedido_id' => 'required|exists:pedidos,id',
        ]);

        $pedido = Pedido::findOrFail($request->pedido_id);

        // Decide se é percentual ou valor fixo
        $percentual = $request->percentual;
        $valorInformado = $request->valor;
        $valor_calculado = null;

        if ($percentual) {
            $valor_calculado = ($pedido->valor_total * $percentual) / 100;
        } elseif ($valorInformado) {
            $valor_calculado = $valorInformado;
        }

        Comissao::create([
            'pedido_id' => $pedido->id,
            'percentual' => $percentual,
            'valor' => $valorInformado,
            'valor_calculado' => $valor_calculado,
        ]);

        return redirect()->route('comissoes.create')->with('success', 'Comissão salva com sucesso!');
    }

    public function relatorioMensal(Request $request)
    {
        $mes = $request->input('mes', date('m'));
        $ano = $request->input('ano', date('Y'));

        $comissoes = Comissao::whereMonth('created_at', $mes)
            ->whereYear('created_at', $ano)
            ->with('pedido.cliente')
            ->get();

        $total = $comissoes->sum('valor_calculado');

        return view('comissoes.relatorio', compact('comissoes', 'total', 'mes', 'ano'));
    }
    public function relatorio(Request $request)
{
    $mes = $request->get('mes', now()->month);
    $ano = $request->get('ano', now()->year);

    $comissoes = Comissao::with(['pedido.cliente'])
        ->whereYear('created_at', $ano)
        ->whereMonth('created_at', $mes)
        ->get();

    $total = $comissoes->sum('valor_calculado');

    return view('comissoes.relatorio', compact('comissoes', 'mes', 'ano', 'total'));
}

}
