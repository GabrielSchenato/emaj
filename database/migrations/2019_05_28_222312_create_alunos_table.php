<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlunosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alunos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome_completo')->nullable(false);
            $table->string('fase')->nullable();
            $table->string('matricula')->nullable();
            $table->string('disciplina')->nullable();
            $table->year('ano')->nullable();
            $table->integer('semestre')->nullable();
            $table->string('turno')->nullable();
            $table->string('celular')->nullable();
            $table->string('telefone')->nullable();
            $table->string('email')->nullable();
            $table->string('observacoes')->nullable();
            $table->boolean('ativo')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alunos');
    }

}
