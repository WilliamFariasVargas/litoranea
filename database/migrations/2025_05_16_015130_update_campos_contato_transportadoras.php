<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('transportadoras', function (Blueprint $table) {
            $table->string('fone_2')->nullable();
            $table->string('fone_3')->nullable();
            $table->string('celular_2')->nullable();
            $table->string('celular_3')->nullable();
            $table->string('email_2')->nullable();
            $table->string('email_3')->nullable();
            $table->string('email_4')->nullable();
            $table->text('observacoes')->nullable();
        });


    }

    public function down(): void
    {
        Schema::table('transportadoras', function (Blueprint $table) {
            $table->dropColumn([
                'fone_2',
                'fone_3',
                'celular_2',
                'celular_3',
                'email_2',
                'email_3',
                'email_4',
                'observacoes',
            ]);


        });
    }
};
