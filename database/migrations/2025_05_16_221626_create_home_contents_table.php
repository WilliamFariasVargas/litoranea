<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_contents', function (Blueprint $table) {
            $table->id(); // Criação do campo id
            $table->string('clientes')->default('0');
            $table->string('anos_experiencia')->default('0');
            $table->string('parceiros')->default('0');
            $table->string('estados')->default('0');
            $table->text('texto_sobre')->nullable(); // Campo de texto sobre
            $table->string('whatsapp', 30)->nullable(); // WhatsApp
            $table->json('logos')->nullable(); // Campo logos como JSON
            $table->timestamps(); // Campos de criação e atualização
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('home_contents'); // Deleta a tabela caso precise reverter
    }
}
