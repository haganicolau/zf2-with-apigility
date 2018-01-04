<?php
namespace Certificate\V1\Rest\Certificate;

class CertificateResourceFactory
{
    public function __invoke($services)
    {
        return new CertificateResource($services->get(\Doctrine\ORM\EntityManager::class));
    }
}
