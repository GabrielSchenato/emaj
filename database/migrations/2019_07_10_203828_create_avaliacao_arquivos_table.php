<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateAvaliacaoArquivosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avaliacao_arquivos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome');
            $table->string('mimetype');
            $table->string('extensao', 10);
            $table->unsignedBigInteger('tamanho');

            $table->unsignedBigInteger('avaliacao_id');
            $table->foreign('avaliacao_id')->references('id')->on('avaliacoes');

            $table->timestamps();
        });
        DB::statement("ALTER TABLE avaliacao_arquivos ADD arquivo LONGBLOB AFTER nome");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('avaliacao_arquivos');
    }
}
