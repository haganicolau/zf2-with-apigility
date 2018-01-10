<?php

/**
 * Class HmacClient responsável por gerar a chave hmac do lado do cliente
 * @author Hagamenon <haganicolau@gmail.com>
 * @version 0.1 
 * @package Application\Service
 */

namespace Application\Service;

/*Dependências*/
use RB\Sphinx\Hmac\HMAC;
use RB\Sphinx\Hmac\Algorithm\HMACv0;
use RB\Sphinx\Hmac\Hash\PHPHash;
use RB\Sphinx\Hmac\Key\StaticKey;
use RB\Sphinx\Hmac\Nonce\SimpleTSNonce;
 
class HmacClient 
{

    /**
    *@var RB\Sphinx\Hmac\HMAC\HMACv0
    */
	private $algo;

	/**
    *@var RB\Sphinx\Hmac\Hash\PHPHash
    */
	private $hash;
	
    /**
    *@var RB\Sphinx\Hmac\Hash\Sha256
    */
	private $key;
	
    /**
    *@var RB\Sphinx\Hmac\Nonce\SimpleTSNonce
    */
	private $nonce;
	
    /**
    *@var RB\Sphinx\Hmac\HMAC
    */
	private $hmacServer;

    /**
     * Constructor que inicia as variáveis do hmac
     *
     * @param String $authorization
     * @return void 
     */
	public function __construct()
	{
		$this->algo = new HMACv0();
		$this->hash = new PHPHash('sha256');
		$this->key = new StaticKey('5b75dd75a325c3823f5944a2f6309b55');
		$this->nonce = new SimpleTSNonce(4);
	}

    /**
     * Estancia o HMAC conforme as variáveis do construtor
     *
     * @return void
     */
	public function init()
	{
		$this->hmacClient = new HMAC(
			$this->algo, 
			$this->hash, 
			$this->key, 
			$this->nonce
		);

		$this->hmacClient->setKeyId('IDaplicacao');
	}

    /**
     * gera chave e nonce para enviar para api
     *
     * @return boolean 
     */
	public function generateHmac()
	{
		$hmac = $this->hmacClient->getHmac('minha mensagem');

		return $this->hmacClient->getNonceValue() . ';' . $hmac;
	}
}