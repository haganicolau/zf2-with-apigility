<?php
/**
 * Created by PhpStorm.
 * User: haganicolau
 * Date: 31/05/18
 * Time: 16:13
 */

namespace Cliente\V1\Rest\Cliente;


class ClienteTO
{
    public function convertDbToDTO($clienteDB)
    {
        $dto = [
            'id' => $clienteDB->getId(),
            'nome' => $clienteDB->getNome(),
            'cpf' => $clienteDB->getCpf(),
            'telefones' => self::setTelefones($clienteDB->getTelefones()),
            'endereco' => self::setEndereco($clienteDB->getEndereco()),
        ];
        return $dto;
    }

    public function convertListDbToDTO($data)
    {
        $lista = array();
        foreach ($data as $item) {
            array_push($lista, self::convertDbToDTO($item));
        }
        return $lista;
    }

    public function setTelefones($telefones)
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
    public function setEndereco($endereco)
    {
        return [
            'id' => $endereco[0]->getId(),
            'logadrouro' => $endereco[0]->getLogradouro(),
            'numero' => $endereco[0]->getNumero(),
            'cep' => $endereco[0]->getCep(),
            'complemento' => $endereco[0]->getComplemento()
        ];
    }
}