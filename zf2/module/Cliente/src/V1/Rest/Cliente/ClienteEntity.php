<?php
namespace Cliente\V1\Rest\Cliente;

use Cliente\V1\Rest\Endereco\EnderecoEntity;
use Cliente\V1\Rest\Telefone\TelefoneEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * @package Cliente\V1\Rest\Cliente;
 * @author Hagamenon Oliveira
 *
 * @ORM\Entity
 * @ORM\Table(name="cliente", options="utf8_general_ci")
 */
class ClienteEntity
{
    /**
     * @var integer Identificador único do registro.
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * @var string nome do cliente
     * @ORM\Column(type="string", length=150)
     * @var string
     */
    private $nome;

    /**
     * @var string cpfe do cliente
     * @ORM\Column(type="string", length=15)
     * @var string
     */
    private $cpf;

    /**
     * @var TelefoneEntity referencia entidade telefones
     * @ORM\OneToMany(targetEntity="\Cliente\V1\Rest\Telefone\TelefoneEntity", mappedBy="cliente", fetch="EAGER", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $telefones;

    /**
     * @var EnderecoEntity referencia entidade endereço
     * @OneToMany(targetEntity="\Cliente\V1\Rest\Endereco\EnderecoEntity", mappedBy="cliente", fetch="EAGER", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $endereco;

    /**
     * @var string email do cliente
     * @ORM\Column(type="string", length=150)
     * @var string
     */
    private $email;

    /**
     * Inicializa classe ClienteEntity
     *
     */
    public function __construct()
    {
        $this->telefones = new ArrayCollection();
        $this->endereco = new ArrayCollection();
    }

    /**
     * @property string getId retorna id do cliente
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @property string getNome retorna nome do cliente
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @property string setNome atribuir nome do cliente
     * @param mixed $nome
     */
    public function setNome($nome = "")
    {
        $this->nome = $nome;
    }

    /**
     * @property string getCpf retorna cpf do cliente
     * @return string
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * @property string setCpf atribuir atribui cpf co cliente
     * @param mixed $cpf
     */
    public function setCpf($cpf = "")
    {
        $this->cpf = $cpf;
    }


    /**
     * @property TelefoneEntity getTelefones retorna telefones do cliente
     * @return TelefoneEntity
     */
    public function getTelefones()
    {
        return $this->telefones;
    }

    /**
     * @property array setTelefones atribui telefones do cliente
     * @param array
     */
    public function setTelefones($telefones)
    {
        $this->telefones = $telefones;
    }

    /**
     * @property EnderecoEntity getEndereco retorna endereco do cliente
     * @return mixed
     */
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * @property array setEndereco atribui endereco do cliente
     * @param array $endereco
     */
    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
    }

    /**
     * @property string getEmail retorna email do cliente
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @property string getEmail atribui email do cliente
     * @param string $email
     */
    public function setEmail($email = "")
    {
        $this->email = $email;
    }
}
