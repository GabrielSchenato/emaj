<?php

namespace Emaj\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\TrimStrings as Middleware;

class TrimStrings extends Middleware
{
    /**
     * The names of the attributes that should not be trimmed.
     *
     * @var array
     */
    protected $except = [
        'password',
        'password_confirmation',
        'nome_cliente',
        'nome_tipo_demanda',
        'nome_aluno',
        'nome_professor',
        'nacionalidade',
        'ficha_triagem',
        'parte_contraria_id',
        'tipo_demanda_id',
        'professor_id',
        'aluno_id',
        'protocolo_id',
        'nacionalidade_id',
        'dia_periodo_id'
    ];
}
