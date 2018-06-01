<?php
/**
 * Created by PhpStorm.
 * User: haganicolau
 * Date: 30/05/18
 * Time: 23:48
 */

namespace Cliente\V1\Rest\Telefone;


use Application\Controller\Interfaces\IEnum;

class EnumTelefone implements IEnum
{

    const __default = self::CELULAR;

    const RESIDENCIAL = 1;
    const CELULAR = 2;
    const COMERCIAL = 3;

    static function getConstants()
    {
        // TODO: Implement getConstants() method.
    }

    static function isValidName()
    {
        // TODO: Implement isValidName() method.
    }

    static function isValidValue()
    {
        // TODO: Implement isValidValue() method.
    }

    static function getName($key = null)
    {
       if($key == 1) {
           return self::RESIDENCIAL;
       }
       if($key == 2) {
           return self::CELULAR;
       }
       if($key == 3) {
           return self::COMERCIAL;
       }
    }

    static function getKey($name = null)
    {
        // TODO: Implement getKey() method.
    }


}

