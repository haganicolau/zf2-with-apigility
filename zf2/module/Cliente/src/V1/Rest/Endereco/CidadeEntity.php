<?php
///**
// * Created by PhpStorm.
// * User: haganicolau
// * Date: 30/05/18
// * Time: 19:19
// */
//
//namespace Cliente\V1\Rest\Endereco;
//use Doctrine\ORM\Mapping as ORM;
//
///**
// * @ORM\Table(name="cidade")
// * @ORM\Entity
// */
//class CidadeEntity
//{
//
//    /**
//     * @var integer Identificador único do registro.
//     *
//     * @ORM\Id
//     * @ORM\Column(type="integer")
//     * @ORM\GeneratedValue(strategy="IDENTITY")
//     */
//    private $id;
//
//    /**
//     * @var string Nome da cidade.
//     *
//     * @ORM\Column(type="string")
//     */
//    private $nome;
//
//
//    /**
//     * @var EstadoEntity Entidade de estado
//     *
//     * @ORM\ManyToOne(targetEntity="EstadoEntity", inversedBy="cidades")
//     * @JoinColumn(name="estado_id", referencedColumnName="id")
//     * @ORM\JoinColumn(nullable=false)
//     */
//    private $estado;
//
//    /**
//     * @return int
//     */
//    public function getId()
//    {
//        return $this->id;
//    }
//
//    /**
//     * @return string
//     */
//    public function getNome()
//    {
//        return $this->nome;
//    }
//
//    /**
//     * @param string $nome
//     */
//    public function setNome($nome)
//    {
//        $this->nome = $nome;
//    }
//
//
//    /**
//     * @return EstadoEntity $estado
//     */
//    public function getEstado()
//    {
//        return $this->estado;
//    }
//
//    /**
//     * @param EstadoEntity
//     */
//    public function setEstado(EstadoEntity $estado)
//    {
//        $this->estado = $estado;
//        return $this;
//    }
//
//
//    public function __toString()
//    {
//        return $this->nome;
//    }
//
//}