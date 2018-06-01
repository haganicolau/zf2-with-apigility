<?php
/**
 * Created by PhpStorm.
 * User: haganicolau
 * Date: 30/05/18
 * Time: 23:48
 */

namespace Cliente\V1\Rest\Telefone;


class EnumTelefone extends \SplEnum
{

    const __default = self::CASA;

    const RESIDENCIAL = 1;
    const CELULAR = 2;
    const COMERCIAL = 3;
}