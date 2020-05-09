<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiaPeriodoAlunosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dia_periodo_alunos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('aluno_id')->unsigned();

            $table->bigInteger('dia_periodo_id')->unsigned();

            $table->foreign('aluno_id')->references('id')->on('alunos')
                ->onDelete('cascade');

            $table->foreign('dia_periodo_id')->references('id')->on('dia_periodos')
                ->onDelete('cascade');
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
        Schema::dropIfExists('dia_periodo_alunos');
    }
}
