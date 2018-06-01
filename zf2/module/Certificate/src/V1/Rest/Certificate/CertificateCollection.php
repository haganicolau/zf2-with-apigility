<?php

/**
 * Classe collection para tratar a coleção e paginação
 * @author Hagamenon <haganicolau@gmail.com>
 * @version 0.1 
 * @package Certificate\V1\Rest\Certificate 
 */
namespace Certificate\V1\Rest\Certificate;

use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;

class CertificateCollection extends Paginator
{
	/**
     * Construtor
     * @param $certificateCollection
     */
    public function __construct($certificateCollection) {
       parent::__construct(new ArrayAdapter($certificateCollection));
    }    
}
