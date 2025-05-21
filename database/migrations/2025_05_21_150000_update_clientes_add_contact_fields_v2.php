<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateClientesAddContactFieldsV2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->string('fone_2', 15)->nullable()->after('fone');
            $table->string('fone_3', 15)->nullable()->after('fone_2');
            $table->string('celular_2', 15)->nullable()->after('celular');
            $table->string('celular_3', 15)->nullable()->after('celular_2');
            $table->string('email_2')->nullable()->after('email');
            $table->string('email_3')->nullable()->after('email_2');
            $table->string('email_4')->nullable()->after('email_3');
            $table->text('observacoes')->nullable()->after('email_4');
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
            $table->dropColumn([
                'fone_2',
                'fone_3',
                'celular_2',
                'celular_3',
                'email_2',
                'email_3',
                'email_4',
                'observacoes'
            ]);
        });
    }
}
