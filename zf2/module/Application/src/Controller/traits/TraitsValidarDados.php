<?php
/**
 * Created by PhpStorm.
 * User: haganicolau
 * Date: 01/06/18
 * Time: 06:40
 */

namespace Application\Controller\traits;


trait TraitsValidarDados
{
    /**
     * validate CPF
     *
     * @param   $cpf
     * @return boolean
     */
    public function validarCpf($cpf = null)
    {
        if(empty($cpf)) {
            return false;
        }

        $cpf = str_replace('.','',$cpf);
        $cpf = str_replace('-','',$cpf);
        $cpf = str_replace(' ','',$cpf);

        if (strlen($cpf) != 11) {
            return false;
        } else if ($cpf == '00000000000' ||
            $cpf == '11111111111' ||
            $cpf == '22222222222' ||
            $cpf == '33333333333' ||
            $cpf == '44444444444' ||
            $cpf == '55555555555' ||
            $cpf == '66666666666' ||
            $cpf == '77777777777' ||
            $cpf == '88888888888' ||
            $cpf == '99999999999') {
            return false;
        } else {

            for ($t = 9; $t < 11; $t++) {

                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $cpf{$c} * (($t + 1) - $c);
                }
                $d = ((10 * $d) % 11) % 10;

                if ($cpf{$c} != $d) {
                    return false;
                }
            }

            return true;
        }
    }

    public function validarCEP($cep = null)
    {
        if(preg_match("/\d{5}-?\d{3}$/", $cep)){
            return true;
        }
        return false;
    }

    public function validarTelefone($phone = null)
    {
        if(preg_match("/^\(?[0-9]{2}\)?\s?9?\d{4}\s?\-?\s?\d{4}$/", $phone)){
            return true;
        }
        return false;
    }

    public function validarEmail($email = null)
    {
        if(preg_match("/\w\@\w+\.\w[a-z]?/", $email)){
            return true;
        }
        return false;
    }


}