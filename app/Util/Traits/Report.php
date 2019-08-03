<?php

namespace Emaj\Util\Traits;

use PHPJasper\PHPJasper;

/**
 * Trait responsável por gerar os relatórios
 *
 * PHP version 7.2
 *
 * @category   Trait
 * @package    Traits
 * @author     Gabriel Schenato <gabriel@uniplaclages.edu.br>
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link       https://www.uniplaclages.edu.br/
 * @since      1.0.0
 */
trait Report
{

    /**
     * Nome do arquivo em jasper
     * @var string 
     */
    protected $nomeRelatorioJasper;

    /**
     * Nome do arquivo que sairá para impressão
     * @var string 
     */
    protected $nomeRelatorio;

    /**
     * Nome que aparecerá no titulo do relatório
     * @var string
     */
    protected $titulo;

    /**
     * Parâmetros de conexão
     * @return array
     */
    protected function getDatabaseConfig()
    {
        return [
            'driver' => env('DB_CONNECTION'),
            'host' => env('DB_HOST'),
            'port' => env('DB_PORT'),
            'username' => env('DB_USERNAME'),
            'password' => env('DB_PASSWORD'),
            'database' => env('DB_DATABASE'),
        ];
    }

    /**
     * Método responsável por gerar as impressões
     * 
     * @return mixed
     */
    public function gerarImpressao()
    {
        $data = $this->getData();
        $formato = $data['formato'];
        unset($data['formato']);

        $options = [
            'format' => [$formato],
            'locale' => 'pt_BR',
            'params' => $data,
            'db_connection' => $this->getDatabaseConfig()
        ];

        $output = storage_path('app/public/' . $this->nomeRelatorioJasper . time());

        $report = new PHPJasper;
        $report->process(
                base_path() . '/relatorios/jasper/' . $this->nomeRelatorioJasper . '.jasper',
                $output,
                $options
        )->execute();

        $file = $output . '.' . $formato;

        ob_end_clean();

        return response()->download($file, $this->nomeRelatorio() . '.' . $formato, [])->deleteFileAfterSend(true);
    }

    /**
     * Método que retorna o nome do relatório
     * @return string
     */
    protected function nomeRelatorio()
    {
        return $this->nomeRelatorio . '_' . now();
    }

    /**
     * Método que retorna os dados que serão enviados para o relatório
     * 
     * @return array
     */
    protected function getData()
    {
        $data = array_merge(request()->all(), [
            'caminho' => base_path(),
            'titulo' => $this->titulo,
            'versao_sistema' => config('app.version'),
            'usuario' => auth()->user()->nome_completo
        ]);
        return $data;
    }

}
