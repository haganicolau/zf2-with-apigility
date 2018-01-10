<?php
/**
 * Classe entidade que vai interagir com o banco por meio do orm doctrine
 * @author Hagamenon <haganicolau@gmail.com>
 * @version 0.1 
 * @package Certificate\V1\Rest\Certificate 
 */

namespace Certificate\V1\Rest\Certificate;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="certificate")
 */
class CertificateEntity
{

	/**
     * @ORM\Id
     * @ORM\GeneratedValue("AUTO")
     * @ORM\Column(type="integer")
     * @var integer
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=250)
     * @var string
     */
    private $name;

    /**
     * @ORM\Column(type="text", length=250)
     * @var string
     */
    private $certificate;

    /**
     * 
     * @return int
     */
    public function getId() 
    {
        return $this->id;
    }

    /**
     * 
     * @return string
     */
    public function getName() 
    {
        return $this->name;
    }

    /**
     * 
     * @param string $name
     * @return \Certificate\V1\Rest\Certificate\CertificateEntity
     */
    public function setName($name) 
    {
        $this->name = $name;
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getCertificate() 
    {
        return $this->certificate;
    }

    /**
     * 
     * @param string $certificate
     * @return \Certificate\V1\Rest\Certificate\CertificateEntity
     */
    public function setCertificate($certificate) 
    {
        $this->certificate = $certificate;
        return $this;
    }

}
