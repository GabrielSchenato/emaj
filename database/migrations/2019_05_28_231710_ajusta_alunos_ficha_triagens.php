<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AjustaAlunosFichaTriagens extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement(' INSERT INTO alunos (nome_completo, created_at, updated_at)
                        SELECT nome_aluno,
                               created_at,
                               updated_at
                        FROM ficha_triagens
                        WHERE nome_aluno IS NOT NULL;');
        DB::statement(' UPDATE ficha_triagens
                        SET aluno_id =
                          (SELECT id
                           FROM alunos
                           WHERE nome_completo = nome_aluno)
                        WHERE nome_aluno IS NOT NULL;');
        Schema::table('ficha_triagens', function (Blueprint $table) {
            $table->dropColumn('nome_aluno');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }

}
