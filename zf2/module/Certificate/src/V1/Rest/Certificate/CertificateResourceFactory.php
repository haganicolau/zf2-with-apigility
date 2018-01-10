<?php
/**
 * Injeção de depedências, no caso do Doctrine
 * @author Hagamenon <haganicolau@gmail.com>
 * @version 0.1 
 * @package Certificate\V1\Rest\Certificate 
 */
namespace Certificate\V1\Rest\Certificate;

class CertificateResourceFactory
{
    public function __invoke($services)
    {
        return new CertificateResource($services->get(\Doctrine\ORM\EntityManager::class));
    }
}
