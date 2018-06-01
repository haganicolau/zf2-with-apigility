<?php
/**
 * Created by PhpStorm.
 * User: haganicolau
 * Date: 01/06/18
 * Time: 19:56
 */

namespace Application\Controller\Interfaces;


interface To
{
    public function convertDbToDTO($data = null);
    public function convertListDbToDTO($data = null);
    public function convertDtoDB($data = null);
}