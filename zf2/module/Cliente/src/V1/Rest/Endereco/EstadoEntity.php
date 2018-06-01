<?php
///**
// * Created by PhpStorm.
// * User: haganicolau
// * Date: 30/05/18
// * Time: 19:20
// */
//
//namespace Cliente\V1\Rest\Endereco;
//use Doctrine\Common\Collections\ArrayCollection;
//use Doctrine\ORM\Mapping as ORM;
//use Doctrine\ORM\Mapping\OneToMany;
//use Doctrine\ORM\Mapping\JoinColumn;
//
///**
// * @ORM\Table(name="estado")
// * @ORM\Entity
// */
//class EstadoEntity
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
//     * @ORM\Column(type="string", length=250)
//     */
//    private $nome;
//
//    /**
//     * @var ArrayCollection Coleção de cidades
//     *
//     * @ORM\OneToMany(targetEntity="CidadeEntity", mappedBy="estado")
//     */
//    private $cidades;
//
//    public function __construct()
//    {
//        $this->cidade = new ArrayCollection();
//    }
//
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
//    /**
//     * @return ArrayCollection $cidades
//     */
//    public function getCidades()
//    {
//        return $this->cidades;
//    }
//
//    /**
//     * @param ArrayCollection $cidades
//     */
//    public function setCidades(ArrayCollection $cidades)
//    {
//        $this->cidades = $cidades;
//    }
//
//
//    public function __toString()
//    {
//        return $this->nome;
//    }
//}