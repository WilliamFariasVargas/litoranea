<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCadastrodepedidoTable extends Migration
{
    public function up()
    {
        Schema::create('cadastrodepedido', function (Blueprint $table) {
            $table->id();
            $table->date('data_pedido')->nullable();
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
            $table->foreignId('representada_id')->constrained('representadas')->onDelete('cascade');
            $table->foreignId('transportadora_id')->nullable()->constrained('transportadoras')->onDelete('cascade');
            $table->decimal('valor_pedido', 10, 2)->default(0);
            $table->decimal('valor_faturado', 10, 2)->default(0);
            $table->date('data_faturamento')->nullable();
            $table->decimal('valor_comissao_parcial', 10, 2)->default(0);
            $table->decimal('valor_comissao_faturada', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cadastrodepedido');
    }
}
