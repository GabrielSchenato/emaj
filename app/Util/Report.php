<?php

namespace Emaj\Util;

use Illuminate\Http\JsonResponse;
use PHPJasper\PHPJasper;

/**
 * Classe responsável por gerar o relatório.
 *
 * PHP Version 7.2
 *
 * @category   Util
 * @package    Util
 * @author     Gabriel Schenato <gabriel@uniplaclages.edu.br>
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link       https://www.uniplaclages.edu.br/
 * @since      2.1.0
 */
class Report
{

    /**
     * Nome do arquivo em jasper sem extensão.
     * 
     * @var string
     */
    private $nomeRelatorioJasper;

    /**
     * Nome que será dado ao arquivo quando gerar a
     * impressão.
     * 
     * @var string 
     */
    private $nomeRelatorio;

    /**
     * Nome que aparecerá no titulo do relatório.
     * 
     * @var string
     */
    private $titulo;

    /**
     * Array com os parâmetros para serem enviados para
     * o relatório.
     * 
     * @var array
     */
    private $parametros = [];

    /**
     * Tipo do formato que será gerado o relatório.
     * 
     * @var string
     */
    private $formato;

    /**
     * Tipo do relatório.
     * 
     * @var int
     */
    private $tipoRelatorio;

    /**
     * Método responsável por retornar os parâmetros de 
     * conexão com o banco de dados.
     * 
     * @return array
     */
    private function getDatabaseConnection()
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

    public function getNomeRelatorioJasper()
    {
        return $this->nomeRelatorioJasper . $this->generateSuffixTipoRelatorio();
    }

    public function getNomeRelatorio()
    {

        return $this->nomeRelatorio ?? $this->getNomeRelatorioJasper();
    }

    public function getTitulo()
    {
        return $this->titulo . $this->generateSuffixTitulo();
    }

    public function getParametros()
    {
        $parametros = array_merge($this->parametros, $this->getDefaultParametros());
        return $parametros;
    }

    public function getFormato()
    {
        return $this->formato ?? FormatoRelatorio::PDF;
    }

    public function getTipoRelatorio()
    {
        return $this->tipoRelatorio;
    }

    public function setNomeRelatorioJasper($nomeRelatorioJasper)
    {
        $this->nomeRelatorioJasper = $nomeRelatorioJasper;
        return $this;
    }

    public function setNomeRelatorio($nomeRelatorio)
    {
        $this->nomeRelatorio = $nomeRelatorio;
        return $this;
    }

    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
        return $this;
    }

    public function setFormato($formato)
    {
        $this->formato = $formato;
        return $this;
    }

    public function setTipoRelatorio($tipoRelatorio)
    {
        $this->tipoRelatorio = $tipoRelatorio;
        return $this;
    }

    /**
     * Método responsável por verificar o tipo do relatório
     * e gerar o tipo de sufixo para o tipo do relatório.
     * 
     * @return string
     */
    private function generateSuffixTipoRelatorio()
    {
        $suffix = "";
        if ($this->getTipoRelatorio() === TipoRelatorio::SINTETICO) {
            $suffix = "_sintetico";
        } elseif ($this->getTipoRelatorio() === TipoRelatorio::ANALITICO) {
            $suffix = "_analitico";
        }
        return $suffix;
    }

    /**
     * Método responsável por verificar o tipo do relatório
     * e gerar o tipo de sufixo do título.
     * 
     * @return string
     */
    private function generateSuffixTitulo()
    {
        $suffix = "";
        if ($this->getTipoRelatorio() === TipoRelatorio::SINTETICO) {
            $suffix = " - " . TipoRelatorio::SINTETICO_DESC;
        } elseif ($this->getTipoRelatorio() === TipoRelatorio::ANALITICO) {
            $suffix = " - " . TipoRelatorio::ANALITICO_DESC;
        }
        return $suffix;
    }

    /**
     * Método que retorna os dados padrões que serão
     * enviado sempre para o relatório.
     * 
     * @return array
     */
    private function getDefaultParametros()
    {
        return [
            'caminho' => base_path(),
            'titulo' => $this->getTitulo(),
            'versao_sistema' => config('app.version'),
            'usuario' => auth()->user()->nome_completo
        ];
    }

    /**
     * Método que retorna as opções para gerar o relatório.
     * 
     * @return array
     */
    private function getOptions()
    {
        return [
            'format' => [$this->getFormato()],
            'locale' => 'pt_BR',
            'params' => $this->getParametros(),
            'db_connection' => $this->getDatabaseConnection()
        ];
    }

    /**
     * Método responsável por gerar um string de um array separado
     * por virgula para ser enviado como parâmetro para a geração do
     * relatório.
     * 
     * @param array $array
     * @param string $key
     * @return string
     */
    public function formatArrayToString($array, $key)
    {
        $string = "";
        if (!is_array($array)) {
            return $string;
        }
        foreach ($array as $item) {
            $value = $item[$key] ?? null;
            if ($value) {
                $string .= "{$item[$key]}, ";
            }
        }

        $formatedString = rtrim($string, ", ");

        return $formatedString;
    }

    /**
     * Método responsável por limpar e adicionar os parâmetros para
     * serem enviados para o relatório.
     * 
     * @param array $parametros
     */
    public function addParametros($parametros)
    {
        foreach ($parametros as $key => $value) {
            if (trim($value) == "") {
                unset($parametros[$key]);
            }
        }
        $this->parametros = $parametros;
        return $this;
    }

    /**
     * Método responsável por gerar o relatório.
     * 
     * @return mixed
     */
    public function generateReport()
    {
        try {
            putenv('LANG=pt_BR.UTF-8');
            $output = storage_path('app/public/' . $this->getNomeRelatorioJasper() . time());

            $PHPJasper = new PHPJasper;
            $PHPJasper->process(
                    base_path() . '/relatorios/jasper/' . $this->getNomeRelatorioJasper() . '.jasper',
                    $output,
                    $this->getOptions()
            )->execute();

            $arquivo = "{$output}.{$this->getFormato()}";
            $relatorio = $this->getNomeRelatorio() . '_' . now() . '.' . $this->getFormato();

            ob_end_clean();

            return response()
                            ->download($arquivo, $relatorio, [])
                            ->deleteFileAfterSend(true);
        } catch (\Exception $ex) {
            return response()->json([
                        'status' => 'error',
                        'errors' => "Não foi possível gerar o relatório, tente novamente. {$ex->getMessage()}"
                            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

}
