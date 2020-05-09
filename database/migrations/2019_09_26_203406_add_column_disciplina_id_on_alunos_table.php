<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddColumnDisciplinaIdOnAlunosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('alunos', function (Blueprint $table) {
            $table->unsignedBigInteger('disciplina_id')->after('disciplina')->nullable(true);
            $table->foreign('disciplina_id')->references('id')->on('disciplinas');
        });

        DB::statement('UPDATE alunos SET disciplina_id = (SELECT id FROM disciplinas WHERE nome = disciplina);');
        Schema::table('alunos', function (Blueprint $table) {
            $table->dropColumn('disciplina');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('alunos', function (Blueprint $table) {
            $table->dropColumn('disciplina_id');
        });
    }
}
