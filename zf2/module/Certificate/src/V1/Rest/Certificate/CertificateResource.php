<?php
/**
 * Classe que é implementado os recursos da api
 * @author Hagamenon <haganicolau@gmail.com>
 * @version 0.1 
 * @package Certificate\V1\Rest\Certificate 
 */

namespace Certificate\V1\Rest\Certificate;

use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;
use Zend\Http\Headers;

class CertificateResource extends AbstractResourceListener
{

    /**
    *@var \Doctrine\ORM\EntityManager
    */
    private $services;

    /**
    *@var String
    */
    private $autorization;

    /**
    *@var String
    */
    private $hmac;

    /**
     * Constructor recebe a depenência do doctrine
     *
     * @param \Doctrine\ORM\EntityManager
     * @return void
     */
    public function __construct($services)
    {
        $this->services = $services;
        $headers = getallheaders();
        $this->autorization = $headers['Authorization'];

        $this->hmac = new HmacService($this->autorization);
        $this->hmac->init();
        
    }

    /**
     * método que cria novo certificado
     *
     * @param  Certificate\V1\Rest\Certificate\CertificateEntity $data
     * @return Certificate\V1\Rest\Certificate\CertificateEntity
     */
    public function create($data)
    {

        if(!$this->hmac->validate()){
            return new ApiProblem(403, 'Execute access forbidden');
        }

        if(!isset($data->name)){
            return new ApiProblem(400, 'Name is required!');
        }

        if(!isset($data->certificate)){
            return new ApiProblem(400, 'Certificate is required!');
        }

        $certificate = new CertificateEntity();
        $certificate->setName($data->name);
        $certificate->setCertificate($data->certificate);
        $this->services->persist($certificate);
        $this->services->flush();
    }

    /**
     * Delete o certificado
     *
     * @param  int $id
     * @return Certificate\V1\Rest\Certificate\CertificateEntity | boolean:false
     */
    public function delete($id)
    {
        if(!$this->hmac->validate()){
            return new ApiProblem(403, 'Execute access forbidden');
        }

        $certificate = $this->services->find(CertificateEntity::class, $id);

        if (!$certificate) {
            return new ApiProblem(400, 'Certificate not found!');
        }

        $this->services->remove($certificate);
        $this->services->flush();
        return TRUE;

    }

    /**
     * Delete a collection, or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function deleteList($data)
    {
        return new ApiProblem(405, 'The DELETE method has not been defined for collections');
    }

    /**
     * Busca um certificado pelo id
     *
     * @param  int $id
     * @return Certificate\V1\Rest\Certificate\CertificateEntity
     */
    public function fetch($id)
    {
        if(!$this->hmac->validate()){
            return new ApiProblem(403, 'Execute access forbidden');
        }

        $certificate = $this->services->find(CertificateEntity::class, $id);
        return $certificate;
    }

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     * @return Certificate\V1\Rest\Certificate\CertificateCollection
     */
    public function fetchAll($params = [])
    {
        if(!$this->hmac->validate()){
            return new ApiProblem(403, 'Execute access forbidden');
        }

        $list = new CertificateCollection(
            $this->services->getRepository(
                CertificateEntity::class
                )->findAll()
            );
        return $list;

    }

    /**
     * Patch (partial in-place update) a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patch($id, $data)
    {
        return new ApiProblem(405, 'The PATCH method has not been defined for individual resources');
    }

    /**
     * Patch (partial in-place update) a collection or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patchList($data)
    {
        return new ApiProblem(405, 'The PATCH method has not been defined for collections');
    }

    /**
     * Replace a collection or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function replaceList($data)
    {
        return new ApiProblem(405, 'The PUT method has not been defined for collections');
    }

    /**
     * Altera o certificado pedido
     *
     * @param  int $id
     * @param  Certificate\V1\Rest\Certificate\CertificateEntity $data
     * @return ApiProblem|mixed
     */
    public function update($id, $data) 
    {

        if(!$this->hmac->validate()){
            return new ApiProblem(403, 'Execute access forbidden');
        }

        if(!isset($data->name)){
            return new ApiProblem(400, 'Name is required!');
        }

        if(!isset($data->certificate)){
            return new ApiProblem(400, 'Certificate is required!');
        }

        $certificate = $this->services->find(CertificateEntity::class, $id);

        if (!$certificate) {
            return new ApiProblem(400, 'Certificate not found!');
        }

        $certificate->setName($data->name);
        $certificate->setCertificate($data->certificate);
        $this->services->flush();

        return $certificate;
    }
}
