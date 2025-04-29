<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Clientes
        Schema::table('clientes', function (Blueprint $table) {
            $table->string('inscricao_estadual', 50)->nullable()->after('cpf_cnpj');
            $table->string('email_nfe', 120)->nullable()->after('email');
        });

        // Transportadoras
        Schema::table('transportadoras', function (Blueprint $table) {
            $table->string('inscricao_estadual', 50)->nullable()->after('cpf_cnpj');
            $table->string('email_nfe', 120)->nullable()->after('email');
        });

        // Representadas
        Schema::table('representadas', function (Blueprint $table) {
            $table->string('inscricao_estadual', 50)->nullable()->after('cpf_cnpj');
            $table->string('email_nfe', 120)->nullable()->after('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->dropColumn(['inscricao_estadual', 'email_nfe']);
        });

        Schema::table('transportadoras', function (Blueprint $table) {
            $table->dropColumn(['inscricao_estadual', 'email_nfe']);
        });

        Schema::table('representadas', function (Blueprint $table) {
            $table->dropColumn(['inscricao_estadual', 'email_nfe']);
        });
    }
};
