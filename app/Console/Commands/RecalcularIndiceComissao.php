<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CadastroDePedido;

class RecalcularIndiceComissao extends Command
{
    protected $signature = 'pedidos:recalcular-indice';

    protected $description = 'Recalcula o índice de comissão baseado no valor do pedido e comissão parcial';

    public function handle()
    {
        $this->info('Iniciando recalculo dos índices de comissão...');

        $pedidos = CadastroDePedido::all();
        $total = $pedidos->count();
        $atualizados = 0;

        foreach ($pedidos as $pedido) {
            if ($pedido->valor_pedido > 0 && $pedido->valor_comissao_parcial > 0) {
                $novoIndice = round(($pedido->valor_comissao_parcial / $pedido->valor_pedido) * 100, 2);
                if ($pedido->indice_comissao != $novoIndice) {
                    $pedido->indice_comissao = $novoIndice;
                    $pedido->save();
                    $atualizados++;
                }
            }
        }

        $this->info("Recalculo concluído: {$atualizados} de {$total} pedidos atualizados.");
    }
}
