<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndiceComissaoToCadastrodepedidoTable extends Migration
{
    public function up()
    {
        Schema::table('cadastrodepedido', function (Blueprint $table) {
            $table->decimal('indice_comissao', 5, 2)->default(0)->after('valor_faturado');
        });
    }

    public function down()
    {
        Schema::table('cadastrodepedido', function (Blueprint $table) {
            $table->dropColumn('indice_comissao');
        });
    }
}
