<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AddTipoDeDemandas extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('tipo_demandas')->insert(
            [
                ['nome' => 'Acordo em Execução de Título Extrajudicial', 'descricao' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['nome' => 'Adjudicação Compulsória', 'descricao' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['nome' => 'Alimentos', 'descricao' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['nome' => 'Alvará Judicial', 'descricao' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['nome' => 'Auxílio Maternidade', 'descricao' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['nome' => 'Cobrança', 'descricao' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['nome' => 'Consulta Jurídica', 'descricao' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['nome' => 'Contestação à Ação de Alimentos', 'descricao' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['nome' => 'Contestação à Ação de Exoneração', 'descricao' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['nome' => 'Contestação à Ação de Exoneração de Alimentos', 'descricao' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['nome' => 'Contestação em Ação de Guarda', 'descricao' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['nome' => 'Cumprimento de Sentença', 'descricao' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['nome' => 'Declaratória', 'descricao' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['nome' => 'Defesa em Medida Protetiva', 'descricao' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['nome' => 'Dissolução de União Estável Litigiosa', 'descricao' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['nome' => 'Divórcio Litigioso', 'descricao' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['nome' => 'Embargos à Execução', 'descricao' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['nome' => 'Embargos à Execução Fiscal', 'descricao' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['nome' => 'Embargos de Terceiro', 'descricao' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['nome' => 'Execução de Alimentos', 'descricao' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['nome' => 'Execução de Título Extrajudicial', 'descricao' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['nome' => 'Exoneração de Alimentos', 'descricao' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['nome' => 'Guarda', 'descricao' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['nome' => 'Homologação Judicial', 'descricao' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['nome' => 'Indenização por Danos Morais', 'descricao' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['nome' => 'Interdição', 'descricao' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['nome' => 'Inventário', 'descricao' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['nome' => 'Inventário Extrajudicial', 'descricao' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['nome' => 'Investigação de Paternidade', 'descricao' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['nome' => 'Justificativa em Cumprimento de Sentença', 'descricao' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['nome' => 'Mandando de Segurança', 'descricao' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['nome' => 'Manifestação em Cumprimento de Sentença', 'descricao' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['nome' => 'Medida Protetiva', 'descricao' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['nome' => 'Modificação de Guarda', 'descricao' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['nome' => 'Negatória de Paternidade', 'descricao' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['nome' => 'Obrigação de Fazer', 'descricao' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['nome' => 'Oferta de Alimentos', 'descricao' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['nome' => 'Ordinária', 'descricao' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['nome' => 'Previdenciária', 'descricao' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['nome' => 'Registro Tardio de Óbito', 'descricao' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['nome' => 'Regulação de Visitas', 'descricao' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['nome' => 'Reintegração de Posse', 'descricao' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['nome' => 'Reparação de Danos', 'descricao' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['nome' => 'Reparação de Danos Materiais', 'descricao' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['nome' => 'Reparação de Danos por Acidente de Trânsito', 'descricao' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['nome' => 'Requerimento Administrativo', 'descricao' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['nome' => 'Retificação de Registro Civil', 'descricao' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['nome' => 'Revisional de Alimentos', 'descricao' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['nome' => 'Revisional de Contrato', 'descricao' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['nome' => 'Usucapião', 'descricao' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ]
        );
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
