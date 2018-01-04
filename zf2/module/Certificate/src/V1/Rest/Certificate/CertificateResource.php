<?php
namespace Certificate\V1\Rest\Certificate;

use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;

class CertificateResource extends AbstractResourceListener
{

    /**
    *@var \Doctrine\ORM\EntityManager
    */
    private $services;

    public function __construct($services){
        $this->services = $services;
    }

    /**
     * Create a resource
     *
     * @param  mixed $data
     * @return Certificate\V1\Rest\Certificate\
     */
    public function create($data)
    {
 
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
     * Delete a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function delete($id)
    {
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
     * Fetch a resource
     *
     * @param  int $id
     * @return Certificate\V1\Rest\Certificate\CertificateEntity
     */
    public function fetch($id)
    {
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
     * Update a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function update($id, $data) {

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
