<?php
namespace Cliente\V1\Rest\Cliente;

use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;

class ClienteCollection extends Paginator
{

    /**
     * Construtor
     * @param $collection
     */
    public function __construct($collection) {
        parent::__construct(new ArrayAdapter($collection));
    }
}
