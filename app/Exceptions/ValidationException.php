<?php

namespace Emaj\Exceptions;

use Illuminate\Validation\ValidationException as ValidationExceptionIlluminate;

/**
 * Classe responsável por lançar exception de validação
 *
 * PHP version 7.2
 *
 * @category   Exception
 * @package    Exceptions
 * @author     Gabriel Schenato <gabriel@uniplaclages.edu.br>
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link       https://www.uniplaclages.edu.br/
 * @since      1.1.1
 */
class ValidationException extends ValidationExceptionIlluminate
{

    protected $wrapName = null;

    /**
     * Método sobrescrito para quando necessário envolver em um outro array para enviar 
     * os erros para o front-end
     * 
     * @return array
     */
    public function errors()
    {
        if ($this->getWrapName()) {
            return [
                $this->getWrapName() => $this->validator->errors()->messages()
            ];
        }
        return $this->validator->errors()->messages();
    }

    public function getWrapName()
    {
        return $this->wrapName;
    }

    /**
     * Utilizado para setar a chave de um array para enviar os 
     * erros de validação para o front-end
     * 
     * @param string $wrapName
     * @return $this
     */
    public function setWrapName($wrapName)
    {
        $this->wrapName = $wrapName;
        return $this;
    }

}
