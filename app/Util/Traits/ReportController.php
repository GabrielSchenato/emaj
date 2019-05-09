<?php

namespace Emaj\Util\Traits;

use Illuminate\Http\Request;
use PHPJasper\PHPJasper;

/**
 * Trait responsável por gerenciar os relatórios
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
trait ReportController
{

    /**
     * Nome do arquivo em jasper
     * @var string 
     */
    protected $nomeRelatorioJasper;

    /**
     * Nome do arquivo que saira para impressão
     * @var string 
     */
    protected $nomeRelatorio;

    /**
     * Nome que aparecerá no titulo do relatório
     * @var string
     */
    protected $titulo;

    /**
     * Reporna um array com os parametros de conexão
     * @return Array
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
        $data = request()->all();
        $formato = $data['formato'];
        unset($data['formato']);

        $data = array_merge($data, [
            'caminho' => base_path(),
            'titulo' => $this->titulo,
            'versao_sistema' => config('app.version'),
            'usuario' => auth()->user()->nome_completo
        ]);

        $options = [
            'format' => [$formato],
            'locale' => 'pt_BR',
            'params' => $data,
            'db_connection' => $this->getDatabaseConfig()
        ];
        // coloca na variavel o caminho do novo relatório que será gerado
        $output = base_path() . '/relatorios/jasper/' . time() . '_' . $this->nomeRelatorioJasper;
// instancia um novo objeto JasperPHP

        $report = new PHPJasper;
// chama o método que irá gerar o relatório
        // passamos por parametro:
        // o arquivo do relatório com seu caminho completo
        // o nome do arquivo que será gerado
        // o tipo de saída
        // parametros ( nesse caso não tem nenhum)         
        $report->process(
                base_path() . '/relatorios/jasper/' . $this->nomeRelatorioJasper . '.jasper',
                $output,
                $options
        )->execute();

        $file = $output . '.' . $formato;

        return response()->download($file, $this->nomeRelatorio() . '.' . $formato, [])->deleteFileAfterSend(true);
    }

    /**
     * Método que retorna o nome do relatório
     * @return string
     */
    protected function nomeRelatorio()
    {
        return $this->nomeRelatorio . '_' . \Carbon\Carbon::now();
    }

}
