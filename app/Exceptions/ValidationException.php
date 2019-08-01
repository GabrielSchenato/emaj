<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Emaj\Exceptions;

use Illuminate\Validation\ValidationException as ValidationExceptionIlluminate;

/**
 * Description of ValidationException
 *
 * @author gabri
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
