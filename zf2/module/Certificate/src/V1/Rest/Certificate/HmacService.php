<?php

/**
 * Classe responsável por verificar se o token do hmac passando pelo header é válido 
 * @author Hagamenon <haganicolau@gmail.com>
 * @version 0.1 
 * @package Certificate\V1\Rest\Certificate
 */

namespace Certificate\V1\Rest\Certificate;

/*Dependências*/
use RB\Sphinx\Hmac\HMAC;
use RB\Sphinx\Hmac\Algorithm\HMACv0;
use RB\Sphinx\Hmac\Hash\PHPHash;
use RB\Sphinx\Hmac\Key\StaticKey;
use RB\Sphinx\Hmac\Nonce\SimpleTSNonce;
use RB\Sphinx\Hmac\Exception\HMACException;
use RB\Sphinx\Hmac\Nonce\DummyNonce;

class HmacService {

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
    *@var String
    */
	private $authorization;

    /**
     * Constructor que inicia as variáveis do hmac
     *
     * @param String $authorization
     * @return void 
     */
	public function __construct($authorization)
	{
		$this->algo = new HMACv0();
		$this->hash = new PHPHash('sha256');
		$this->key = new StaticKey('5b75dd75a325c3823f5944a2f6309b55');
		$this->nonce = new SimpleTSNonce(4);
		$this->authorization = $authorization;
	}

    /**
     * Estancia o HMAC conforme as variáveis do construtor
     *
     * @return void
     */
	public function init()
	{
		$this->hmacServer = new HMAC( 
			$this->algo, 
			$this->hash, 
			$this->key, 
			$this->nonce
		);

		$this->hmacServer->setKeyId('IDaplicacao');
	}

    /**
     * Verifica se o valor recebido pelo header é válido
     *
     * @return boolean 
     */
	public function validate()
	{

		$this->authorization = explode(';', $this->authorization);
		
		$this->hmacServer->setNonceValue($this->authorization[0]);
		
		try {

		    $this->hmacServer->validate ('minha mensagem', $this->authorization[1]);   
		    return true;

		} catch( HMACException $exception ) {

		    return false;

		}
	}

}