<?php

/**
 * Class ResourcesApi responsável por fazer uso dos recursos da api
 * @author Hagamenon <haganicolau@gmail.com>
 * @version 0.1 
 * @package Application\Service
 */

namespace Application\Service;

use Zend\Http\Request;
use Zend\Http\Client;

class ResourcesApi {

    /**
     * API Address
     * @var string 
     */
    private static $urlApi = "http://api.zf2.com/certificate";

    private $params = null;
    private $body = null;
    private $is_put = false;

    /**
     * 
     * @param $data
     * @return boolean|string
     */
    public function post($data) {
        $this->body = $data;
        return $this->getResponse(Request::METHOD_POST);
    }

    /**
     * 
     * @param $data
     * @return boolean|string
     */
    public function put($data) {
        $this->body = $data;
        $this->params = $data['id'];
        $this->is_put = true;
        return $this->getResponse(Request::METHOD_PUT);
    }

    /**
     * 
     * @return list of certificates
     */
    public function getCertificates() {
        return $this->getResponse(Request::METHOD_GET);
    }

    /**
     * 
     * @param int $id
     * @return array()
     */
    public function getCertificate($id) {
        $this->params = $id;
        return $this->getResponse(Request::METHOD_GET);
    }

    /**
     * 
     * @param int $id
     * @return boolean
     */
    public function delete($id) {
        $this->params = $id;
        return $this->getResponse(Request::METHOD_DELETE);
    }

    /**
     * 
     * @return void
     */
    public function setPrintar(){
        $this->printar = true;
    }

    /**
     * 
     * @param int $method
     * @return array
     */
    private function getResponse($method) {

        $client = new Client(self::$urlApi);
 
        if ($this->params) {
            $uri = self::$urlApi . '/' . $this->params;
            $client = new Client($uri);
            $this->params = false;
        }

        if ($this->body) {
            $client->setEncType(Client::ENC_FORMDATA);
            $client->setParameterPost($this->body);
            $this->body = false;
        }

        $response = '';

        if($this->is_put){
            $client->setEncType(Client::ENC_FORMDATA);

            $response = $client->setMethod($method)
                ->setHeaders(['Content-Type' => 'application/json'])
                ->send();
        }
        else{
            $response = $client->setMethod($method)
                ->setHeaders(['Accept' => 'application/json'])
                ->send();
        }

        if ($response->isSuccess()) {
            return $response->getContent() ?: TRUE;
        }

        return FALSE;
    }

}
