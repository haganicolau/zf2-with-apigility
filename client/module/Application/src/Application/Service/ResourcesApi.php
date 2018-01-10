<?php

/**
 * Class ResourcesApi responsável por fazer uso dos recursos da api
 * @author Hagamenon <haganicolau@gmail.com>
 * @version 0.1 
 * @package Application\Service
 */

namespace Application\Service;

/*Dependências*/
use Zend\Http\Request;
use Zend\Http\Client;
use Application\Service\HmacClient;

class ResourcesApi {

    /**
     * API Address
     * @var string 
     */
    private static $urlApi = "http://api.zf2.com/certificate";

    /** 
    * atributo para setar os dados a serem enviados por parâmetros 
    * @access private 
    * @name $params 
    */ 
    private $params = null;

    /** 
    * atributo para setar os dados a serem enviados no body 
    * @access private 
    * @name $body
    */ 
    private $body = null;

    /** 
    * Mudar o envio dos dados no getResponse, para isto eu seto que será uma requisição do tipo put 
    * @access private 
    * @name $params 
    */ 
    private $is_put = false;

    /** 
    * Responsável por gerar autenticação com o servidor, garantindo que a requição é válida 
    * @access private 
    * @name $hmac 
    */ 
    private $token;

    /** 
    * Construtor inicializando classe para fazer uso da api
    * @access public 
    * @return void 
    */ 
    public function __construct() {
        $hmac = new HmacClient();
        $hmac->init();
        $this->token = $hmac->generateHmac();
    }

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
     * Método responsável por efetuar as requisições depois de configuradas
     * @param int $method
     * @return array
     */
    private function getResponse($method) {

        $client=null;
        $header = [];
 
        if ($this->params) {
            $uri = self::$urlApi . '/' . $this->params;
            $client = new Client($uri);
            $this->params = false;
        }

        if(!$client){
            $client = new Client(self::$urlApi);
        }

        if($this->is_put){
            $client->setRawBody(json_encode($this->body));
            $header = [
                'Content-Type' => 'application/json',
                'Authorization' => $this->token
            ];
        }
        else{
            if ($this->body) {
                $client->setEncType(Client::ENC_FORMDATA);
                $client->setParameterPost($this->body);
                $this->body = false;
            }
            
            $header = [
                'Accept' => 'application/json',
                'Authorization' => $this->token
            ];

        }

        $client->setHeaders($header);
        $response = $client->setMethod($method)    
            ->send();

        if ($response->isSuccess()) {
            return $response->getContent() ?: TRUE;
        }

        return FALSE;
    }

}
