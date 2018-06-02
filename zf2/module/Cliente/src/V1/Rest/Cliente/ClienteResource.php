<?php
namespace Cliente\V1\Rest\Cliente;

use Cliente\V1\Rest\Telefone\EnumTelefone;
use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;
use Application\Controller\traits\TraitsValidarDados;

class ClienteResource extends AbstractResourceListener
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

    use TraitsValidarDados;

    /**
     * Constructor recebe a depenência do doctrine
     *
     * @param \Doctrine\ORM\EntityManager
     * @return void
     */
    public function __construct($services)
    {
        $this->services = $services;
    }

    /**
     * Create a resource
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function create($data)
    {
        $retorno = self::validateFields($data);
        if($retorno['code'] != 200) {
            return new ApiProblem($retorno['code'], $retorno['mensagem']);
        }
        $to = new ClienteTO();

        try{
            $cliente = $to->convertDtoDB($data);
            $this->services->persist($cliente);
            $this->services->flush();

        } catch(Exception $ex) {
            return new ApiProblem(500, $ex->getMessage());
        }
    }

    /**
     * Delete a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function delete($id)
    {
        $clienteDB = $this->services->find(ClienteEntity::class, $id);
        if(empty($clienteDB)){
            return new ApiProblem(404, 'Cliente não encontrado');
        }

        $this->services->remove($clienteDB);
        $this->services->flush();
        return new ApiProblem(200, 'Deletado com sucesso');
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
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function fetch($id)
    {
        $clienteDB = $this->services->find(ClienteEntity::class, $id);
        if(empty($clienteDB)){
            return new ApiProblem(404, 'Cliente não encontrado');
        }

        $to = new ClienteTO();
        $response = $to->convertDbToDTO($clienteDB);

        return $response;
    }

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = [])
    {
        $to = new ClienteTO();

        $list = $to->convertListDbToDTO(
            $this->services->getRepository(
                ClienteEntity::class
            )->findAll()
        );

        if(empty($list)){
            return new ApiProblem(404, 'Not Found');
        }
        return new ClienteCollection($list);
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
    public function update($id, $data)
    {
        $retorno = self::validateFields($data);
        $to = new ClienteTO();

        if($retorno['code'] != 200) {
            return new ApiProblem($retorno['code'], $retorno['mensagem']);
        }

        $oldDB = $this->services->find(ClienteEntity::class, $id);
        $oldDB->setNome($data->nome);
        $oldDB->setCpf($data->cpf);
        $oldDB->setEmail($data->email);

        if(isset($data->telefones)) {
            foreach($oldDB->getTelefones() as $item) {
                $this->services->remove($item);
            }
            $oldDB->setTelefones($to->setTelefonesDB($data->telefones, $oldDB));
        }

        if(isset($data->endereco)) {
            $this->services->remove( $oldDB->getEndereco()[0]);
            $oldDB->setEndereco($to->setEnderecoDB($data->endereco, $oldDB));
        }

        try{
            $this->services->persist($oldDB);
            $this->services->flush();

        } catch(Exception $ex) {
            return new ApiProblem(500, $ex->getMessage());
        }
    }

    /**
     * validate Filds data
     *
     * @param   $data object request
     * @return array
     */
    private function validateFields($data)
    {
        if(!isset($data->nome)) {
            return ['code' => 400, 'mensagem' => 'Nome requerido'];
        }

        if(!isset($data->cpf)) {
            return ['code' => 400, 'mensagem' => 'CPF requerido'];
        }

        if(!$this->validarCpf($data->cpf)) {
            return ['code' => 400, 'mensagem' => 'CPF inválido'];
        }

        if(!isset($data->email)) {
            return ['code' => 400, 'mensagem' => 'Email requirido'];
        }

        if(isset($data->telefones)) {
            foreach($data->telefones as $telefone) {
                if (!$this->validarTelefone($telefone['numero'])){
                    return ['code' => 400, 'mensagem' => 'Telefone inválido'];
                }
                if(!isset($telefone['tipo'])) {
                    return ['code' => 400, 'mensagem' => 'Telefone sem tipo definido'];
                }
                if($telefone['tipo'] =! EnumTelefone::CELULAR ||
                    $telefone['tipo'] =! EnumTelefone::RESIDENCIAL ||
                    $telefone['tipo'] =! EnumTelefone::COMERCIAL) {
                    return ['code' => 400, 'mensagem' => 'Tipo Telefone Inválido'];
                }
            }
        }

        if(isset($data->endereco)) {
            if(!isset($data->endereco['logradouro'])){
                return ['code' => 400, 'mensagem' => 'Endereço sem logradouro'];
            }

            if(!isset($data->endereco['numero'])) {
                return ['code' => 400, 'mensagem' => 'Endereço sem numero'];
            }

            if(!isset($data->endereco['cep'])) {
                return ['code' => 400, 'mensagem' => 'Endereço sem CEP'];
            }

            if (!$this->validarCEP($data->endereco['cep'])) {
                return ['code' => 400, 'mensagem' => 'CEP inválido'];
            }

            if(!isset($data->endereco['bairro'])) {
                return ['code' => 400, 'mensagem' => 'Endereço sem Bairro'];
            }

            if(!isset($data->endereco['cidade'])) {
                return ['code' => 400, 'mensagem' => 'Endereço sem Cidade'];
            }

            if(!isset($data->endereco['uf'])) {
                return ['code' => 400, 'mensagem' => 'Endereço sem UF'];
            }
        }

        if(isset($data->email)) {
            if (!$this->validarEmail($data->email)) {
                return ['code' => 400, 'mensagem' => 'Email inválido'];
            }
        }

        return ['code' => 200];
    }
}
