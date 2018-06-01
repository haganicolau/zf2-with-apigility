<?php
/**
 * Created by PhpStorm.
 * User: haganicolau
 * Date: 01/06/18
 * Time: 19:01
 */

namespace Application\Controller\Interfaces;


interface IEnum
{
    static function getConstants();
    static function isValidName();
    static function isValidValue();
    static function getName($key = null);
    static function getKey($name = null);
}