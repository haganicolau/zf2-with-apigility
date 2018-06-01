<?php
namespace Cliente\V1\Rest\Cliente;

class ClienteResourceFactory
{
    public function __invoke($services)
    {
        return new ClienteResource($services->get(\Doctrine\ORM\EntityManager::class));
    }
}
