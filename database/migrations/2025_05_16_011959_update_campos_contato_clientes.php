<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('clientes', function (Blueprint $table) {



            $table->dropUnique(['cpf_cnpj']);
            $table->dropUnique(['email']);
        });
    }

    public function down(): void
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->dropColumn([


            ]);

            $table->unique('cpf_cnpj');
            $table->unique('email');
        });
    }
};
