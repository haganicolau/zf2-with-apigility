<?php
/**
 * Created by PhpStorm.
 * User: haganicolau
 * Date: 30/05/18
 * Time: 23:48
 */

namespace Cliente\V1\Rest\Telefone;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * @ORM\Entity
 * @ORM\Table(name="telefone")
 */
class TelefoneEntity
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
     * @var int tipo telefone.
     *
     * @ORM\Column(type="integer")
     */
    private $tipo;

    /**
     * @var string numero telefone.
     *
     * @ORM\Column(type="string", length=15)
     */
    private $numero;

    /**
     * @ManyToOne(targetEntity="\Cliente\V1\Rest\Cliente\ClienteEntity", inversedBy="telefones", cascade={"all"})
     * @JoinColumn(name="id_cliente", referencedColumnName="id")
     */
    private $cliente;

    public function __construct($numero, $tipo)
    {
        $this->tipo = EnumTelefone::getName($tipo);
        $this->numero = $numero;
    }

    public function getTipo(){
        return $this->tipo;
    }

    public function getNumero(){
        return $this->numero;
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