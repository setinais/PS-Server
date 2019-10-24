<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInformacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informacoes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome');
            $table->string('localizacao')->nullable();
            $table->string('endereco');
            $table->string('bairro');
            $table->string('telefone');
            $table->string('descricao');
            $table->string('imagem');
            $table->json('servicos')->nullable();
            $table->string('cidade');
            $table->string('estado');
            $table->enum('type', ['HPT', 'UBS']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('informacoes');
    }
}
