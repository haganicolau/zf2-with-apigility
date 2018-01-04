<?php
namespace Certificate\V1\Rest\Certificate;

use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;

class CertificateCollection extends Paginator
{
	/**
     * Construtor
     * @param type $certificateCollection
     */
    public function __construct($certificateCollection) {

       parent::__construct(new ArrayAdapter($certificateCollection));
    }    
}
