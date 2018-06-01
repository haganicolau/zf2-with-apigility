<?php
/**
 * Created by PhpStorm.
 * User: haganicolau
 * Date: 31/05/18
 * Time: 16:13
 */

namespace Cliente\V1\Rest\Cliente;


use Cliente\V1\Rest\Endereco\EnderecoEntity;
use Cliente\V1\Rest\Telefone\TelefoneEntity;
use Application\Controller\Interfaces\To;

class ClienteTO implements To
{
    public function convertDbToDTO($clienteDB = null)
    {
        $dto = [
            'id' => $clienteDB->getId(),
            'nome' => $clienteDB->getNome(),
            'cpf' => $clienteDB->getCpf(),
            'telefones' => self::setTelefonesTO($clienteDB->getTelefones()),
            'endereco' => self::setEnderecoTO($clienteDB->getEndereco()),
        ];
        return $dto;
    }

    public function convertListDbToDTO($data = null)
    {
        $lista = array();
        foreach ($data as $item) {
            array_push($lista, self::convertDbToDTO($item));
        }
        return $lista;
    }

    public function setTelefonesTO($telefones = null)
    {
        $resposta = array();
        foreach ($telefones as $item) {
            array_push(
                $resposta, [
                    'id' => $item->getId(),
                    'telefone' => $item->getNumero(),
                    'tipo' => $item->getTipo()
                ]
            );
        }
        return $resposta;
    }

    /**
     * @param mixed $endereco
     */
    public function setEnderecoTO($endereco = null)
    {
        return [
            'id' => $endereco[0]->getId(),
            'logadrouro' => $endereco[0]->getLogradouro(),
            'numero' => $endereco[0]->getNumero(),
            'cep' => $endereco[0]->getCep(),
            'complemento' => $endereco[0]->getComplemento()
        ];
    }

    public function convertDtoDB($to = null)
    {
        $cliente = new ClienteEntity();
        $cliente->setNome($to->nome);
        $cliente->setCpf($to->cpf);
        $cliente->setTelefones(self::setTelefonesDB($to->telefones, $cliente));
        $cliente->setEndereco(self::setEnderecoDB($to->endereco, $cliente));
        $cliente->setEmail($to->email);

        return $cliente;
    }

    public function setTelefonesDB($telefones = array(), $cliente = null)
    {
        $phones = array();
        foreach ($telefones as $item) {
            $telefone = new TelefoneEntity($item['numero'], $item['tipo']);
            $telefone->setCliente($cliente);
            array_push($phones, $telefone);
        }
        return $phones;
    }

    /**
     * @param mixed $endereco
     */
    public function setEnderecoDB($endereco = array(), $cliente = null)
    {
        $end = new EnderecoEntity();
        $end->setBairro($endereco['bairro']);
        $end->setLogradouro($endereco['logradouro']);
        $end->setNumero($endereco['numero']);
        $end->setCep($endereco['cep']);
        $end->setCidade($endereco['cidade']);
        $end->setUf($endereco['uf']);
        $end->setCliente($cliente);
        return [$end];
    }

}