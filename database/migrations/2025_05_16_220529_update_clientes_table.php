<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clientes', function (Blueprint $table) {
            // Adicionando ou modificando os campos conforme necessário

            // 'tipo_pessoa' - assume-se que já exista e é do tipo integer.
            $table->tinyInteger('tipo_pessoa')->change(); // Garante que a coluna existe com o tipo correto

            // Campos para 'cpf_cnpj', 'inscricao_estadual', etc.
            $table->string('cpf_cnpj')->change();
            $table->string('inscricao_estadual')->nullable()->change();

            // Campos de razão social, nome fantasia e responsável
            $table->string('razao_social')->nullable()->change();
            $table->string('nome_fantasia')->nullable()->change();
            $table->string('responsavel')->nullable()->change();

            // E-mails
            $table->string('email')->nullable()->change();
            $table->string('email_2')->nullable()->change();
            $table->string('email_3')->nullable()->change();
            $table->string('email_4')->nullable()->change();
            $table->string('email_nfe')->nullable()->change();

            // Telefones e celular
            $table->string('fone')->nullable()->change();
            $table->string('fone_2')->nullable()->change();
            $table->string('fone_3')->nullable()->change();
            $table->string('celular')->nullable()->change();
            $table->string('celular_2')->nullable()->change();
            $table->string('celular_3')->nullable()->change();

            // Endereço
            $table->string('cep')->nullable()->change();
            $table->string('rua')->nullable()->change();
            $table->string('numero')->nullable()->change();
            $table->string('complemento')->nullable()->change();
            $table->string('bairro')->nullable()->change();
            $table->string('cidade')->nullable()->change();
            $table->string('uf')->nullable()->change();

            // Observações
            $table->text('observacoes')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clientes', function (Blueprint $table) {
            // Caso precise reverter as alterações, por exemplo, removendo os campos ou alterando os tipos novamente.
            $table->string('cpf_cnpj')->change();
            $table->string('inscricao_estadual')->change();
            $table->string('razao_social')->change();
            $table->string('nome_fantasia')->change();
            $table->string('responsavel')->change();
            $table->string('email')->change();
            $table->string('email_2')->change();
            $table->string('email_3')->change();
            $table->string('email_4')->change();
            $table->string('email_nfe')->change();
            $table->string('fone')->change();
            $table->string('fone_2')->change();
            $table->string('fone_3')->change();
            $table->string('celular')->change();
            $table->string('celular_2')->change();
            $table->string('celular_3')->change();
            $table->string('cep')->change();
            $table->string('rua')->change();
            $table->string('numero')->change();
            $table->string('complemento')->change();
            $table->string('bairro')->change();
            $table->string('cidade')->change();
            $table->string('uf')->change();
            $table->text('observacoes')->change();
        });
    }
}
