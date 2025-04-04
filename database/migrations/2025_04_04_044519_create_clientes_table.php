<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->integer('tipo_pessoa')->comment('1 - Juridica, 2 - Física');
            $table->string("cpf_cnpj",20)->nullable();
            $table->string("razao_social",250);
            $table->string("nome_fantasia",250);
            $table->string('responsavel',180)->nullable();
            $table->string("email",120)->nullable();
            $table->string("fone",20)->nullable();
            $table->string("celular")->nullable();
            $table->string("cep",15)->nullable();
            $table->string("rua",120)->nullable();
            $table->string("numero",10)->nullable();
            $table->string("complemento",50)->nullable();
            $table->string("bairro",80)->nullable();
            $table->string("cidade",120)->nullable();
            $table->char("uf",2)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
