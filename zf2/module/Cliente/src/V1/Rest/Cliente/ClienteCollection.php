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

//    public function getAdapter() {
//        return $this->getAdapter();
//    }

//    private $clienteDTO;
//    private $clientesDTO;
//
//    /**
//     * Construtor
//     * @param type $certificateCollection
//     */
//    public function __construct()
//    {
//        $this->clienteDTO = new ClienteTO();
//        $this->clientesDTO = array();
//    }
//
//    public function convertDbToDTO($data)
//    {
//        $this->clienteDTO->setId($data->getId());
//        $this->clienteDTO->setNome($data->getNome());
//        $this->clienteDTO->setCpf($data->getCpf());
//        $this->clienteDTO->setTelefones($data->getTelefones());
//        $this->clienteDTO->setEndereco($data->getEndereco());
//        return $this->clienteDTO;
//    }
//
//    public function convertListDbToDTO($data)
//    {
//        foreach ($data as $item) {
//            array_push($this->clientesDTO, self::convertDbToDTO($item));
//        }
//        parent::__construct(new ArrayAdapter($this->clientesDTO));
//        return $this->getAdapter();
//    }

}
