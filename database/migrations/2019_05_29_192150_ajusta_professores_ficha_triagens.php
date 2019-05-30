<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AjustaProfessoresFichaTriagens extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $password = '$2y$10$yErVfcrgEwhvh1nlFVF15u.8Wpi3DI.BXs9LKRDIE8ClxErgacQBW';
        DB::statement(" INSERT INTO usuarios (nome_completo, email, password, role, telefone, professor, ativo, created_at, updated_at)
                        SELECT 
                        	   nome_professor,
                        	   concat(REPLACE(LEFT(LCASE(nome_professor), 10), ' ', ''), '@uniplaclages.edu.br')  as email,
                        	   '{$password}' as password,
                        	   'admin' as role,
                        	   '(49) 00000-0000' as telefone,
                        	   1 as professor,
                        	   1 as ativo,
                                   now() as created_at,
                                   now() as updated_at
                        FROM ficha_triagens
                        WHERE nome_professor IS NOT NULL
                        GROUP BY nome_professor;");
                                   
        DB::statement(' UPDATE ficha_triagens
                        SET professor_id =
                          (SELECT id
                           FROM usuarios
                           WHERE nome_completo = nome_professor)
                        WHERE nome_professor IS NOT NULL;');
        
        Schema::table('ficha_triagens', function (Blueprint $table) {
            $table->dropColumn('nome_professor');
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
