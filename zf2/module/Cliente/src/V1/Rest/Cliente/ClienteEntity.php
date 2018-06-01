<?php
namespace Cliente\V1\Rest\Cliente;

use Cliente\V1\Rest\Telefone\TelefoneEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * @ORM\Entity
 * @ORM\Table(name="cliente")
 */
class ClienteEntity
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
     * @ORM\Column(type="string", length=150)
     * @var string
     */
    private $nome;

    /**
     * @ORM\Column(type="string", length=15)
     * @var string
     */
    private $cpf;

    /**
     * @var TelefoneEntity
     *
     * @ORM\OneToMany(targetEntity="\Cliente\V1\Rest\Telefone\TelefoneEntity", mappedBy="cliente", fetch="EAGER")
     */
    private $telefones;

    /**
     * @OneToMany(targetEntity="\Cliente\V1\Rest\Endereco\EnderecoEntity", mappedBy="cliente", fetch="EAGER")
     */
    private $endereco;

    public function __construct()
    {
//        $this->telefones = new ArrayCollection();
//        $this->endereco = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return string
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * @param mixed $cpf
     */
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }


    /**
     * @return TelefoneEntity
     */
    public function getTelefones()
    {
        return $this->telefones;
    }

    /**
     * @param TelefoneEntity
     */
    public function setTelefones($telefones)
    {
        var_dump($telefones);exit();
        $this->telefones = $telefones;
    }

    /**
     * @return mixed
     */
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * @param mixed $endereco
     */
    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
    }


}
