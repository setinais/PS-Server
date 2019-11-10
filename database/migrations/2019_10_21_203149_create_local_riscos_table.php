<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocalRiscosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('local_riscos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('localizacao');
            $table->string('descricao');
            $table->string('endereco')->nullable();
            $table->string('imagem')->nullable();
            $table->string('bairro')->nullable();
            $table->enum('status', ['A', 'R', 'T', 'B'])->default('T'); //A - Aprovado, R - Reprovado, T - EM teste, B - Resolvido dado baixa
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
        Schema::dropIfExists('local_riscos');
    }
}
