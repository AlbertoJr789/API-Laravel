<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PacoteProdutoRule implements Rule
{

    private $faltando = '';
    private $erro = '';

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (!is_numeric($value)) {

            if (!isset($value['peso'])) {
                $this->faltando .= 'peso, ';
            } else {
                if (!is_numeric($value['peso'])) {
                    $this->erro .= 'peso, ';
                }
            }

            if (!isset($value['altura'])) {
                $this->faltando .= 'altura, ';
            } else {
                if (!is_numeric($value['altura'])) {
                    $this->erro .= 'altura, ';
                }
            }

            if (!isset($value['largura'])) {
                $this->faltando .= 'largura, ';
            } else {
                if (!is_numeric($value['largura'])) {
                    $this->erro .= 'largura, ';
                }
            }

            if (!isset($value['profundidade'])) {
                $this->faltando .= 'profundidade, ';
            } else {
                if (!is_numeric($value['profundidade'])) {
                    $this->erro .= 'profundidade, ';
                }
            }

            if ($this->faltando) {
                return false;
            }
            
            if ($this->erro) {
                return false;
            }
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        $erroMsg = 'Pacote: ';

        if ($this->faltando)
            $erroMsg .= "falta(m) o(os) campo(s): $this->faltando | ";
        if ($this->erro)
            $erroMsg .= "$this->erro deve(m) ter valor numérico";

        return $erroMsg;
    }
}
