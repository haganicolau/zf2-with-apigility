<?php
/**
 * Created by PhpStorm.
 * User: haganicolau
 * Date: 30/05/18
 * Time: 19:18
 */

namespace Cliente\V1\Rest\Endereco;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\OneToOne;


/**
 * @ORM\Table(name="endereco")
 * @ORM\Entity
 */
class EnderecoEntity
{
    /**
     * @var integer Identificador único do registro.
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $logradouro;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $numero;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $cep;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $bairro;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $complemento;

    /**
     * @ManyToOne(targetEntity="\Cliente\V1\Rest\Cliente\ClienteEntity", inversedBy="endereco", cascade={"all"})
     * @JoinColumn(name="id_cliente", referencedColumnName="id")
     */
    private $cliente;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $cidade;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $uf;

    public function __construct()
    {

    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getLogradouro()
    {
        return $this->logradouro;
    }

    /**
     * @param mixed $logradouro
     */
    public function setLogradouro($logradouro = "")
    {
        $this->logradouro = $logradouro;
    }

    /**
     * @return string
     */
    public function getCidade()
    {
        return $this->cidade;
    }

    /**
     * @param string $cidade
     */
    public function setCidade($cidade = "")
    {
        $this->cidade = $cidade;
    }

    /**
     * @return mixed
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * @param mixed $numero
     */
    public function setNumero($numero = "")
    {
        $this->numero = $numero;
    }

    /**
     * @return mixed
     */
    public function getCep()
    {
        return $this->cep;
    }

    /**
     * @param mixed $cep
     */
    public function setCep($cep = "")
    {
        $this->cep = $cep;
    }

    /**
     * @return mixed
     */
    public function getBairro()
    {
        return $this->bairro;
    }

    /**
     * @param mixed $bairro
     */
    public function setBairro($bairro = "")
    {
        $this->bairro = $bairro;
    }

    /**
     * @return mixed
     */
    public function getComplemento()
    {
        return $this->complemento;
    }

    /**
     * @param mixed $complemento
     */
    public function setComplemento($complemento = "")
    {
        $this->complemento = $complemento;
    }

    /**
     * @return string
     */
    public function getUf()
    {
        return $this->uf;
    }

    /**
     * @param string $uf
     */
    public function setUf($uf = "")
    {
        $this->uf = $uf;
    }

    /**
     * @return mixed
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * @param mixed $cliente
     */
    public function setCliente($cliente)
    {
        $this->cliente = $cliente;
    }
}