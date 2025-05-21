<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeContentsTable extends Migration
{
    public function up()
    {
        Schema::create('home_contents', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();
            $table->string('foto_sobre')->nullable();
            $table->string('clientes')->default('0');
            $table->string('anos_experiencia')->default('0');
            $table->string('parceiros')->default('0');
            $table->string('estados')->default('0');
            $table->text('texto_sobre')->nullable();
            $table->string('whatsapp')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('home_contents');
    }
}
