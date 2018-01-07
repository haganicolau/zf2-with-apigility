<?php

/**
 * Class controller resonsável por obter as regras de negócio de certificado
 * @author Hagamenon <haganicolau@gmail.com>
 * @version 0.1 
 * @package Application 
 */

namespace Application\Controller;


/*Dependências*/
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Helper;
use Application\Service\ResourcesApi;
use phpseclib\File\X509;
use Application\Form\CertificateForm;
use Zend\View\Model\JsonModel;

class IndexController extends AbstractActionController {

    /** 
    * método para usar os recursos da api. 
    * @access private 
    * @name $resources 
    */ 
    private $resources;

    /** 
    * Construtor inicializando classe para fazer uso da api
    * @access public 
    * @return void 
    */ 
    public function __construct() {
        $this->resources = new ResourcesApi();
    }

    /** 
    * Função executada ao iniciar o controller, objetivo, desativar a renderização automática do ZEND para funções ajax
    * @access public 
    * @return void 
    */ 
    public function init(){
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->removeHelper('viewRenderer');
         Zend_Controller_Front::getInstance()
            ->setParam('noViewRenderer', true);
    }

    /** 
    * Função carrega a lista de certificados salvos
    * @access public 
    * @return Zend\View\Model\ViewModel 
    */ 
    public function indexAction() {
        $message = '';
        $header = '';
        $list_certificates = $this->resources->getCertificates();

        if (!$list_certificates) {
           $this->flashMessenger()->addErrorMessage("Erro ao consultar Certificados.");
        }

        $list_certificates = json_decode($list_certificates);

        $form = new CertificateForm('upload-form');

        return new ViewModel(compact('message', 'header', 'list_certificates', 'form'));
    }

    /** 
    * Função obtém os dados do formulário de cadastro para salvar via ajax
    * @access public 
    * @return Zend\View\Model\JsonModel 
    */ 
    public function createAction() {

        $form = new CertificateForm('upload-form');
        $data = $this->getRequest()->getPost()->toArray();


        $cert = [
            'name' => $data['name'],
            'certificate' => $data['file']
        ];

        $response = [];

        if ($this->resources->post($cert)) {

            $response = [
                'status' => 'ok',
                'message' => 'Certificado cadastrado com sucesso.'
            ];

        } else {
            $response = [
                'status' => 'ok',
                'message' => 'Erro ao cadastrar Certificado. Tente novamente.'
            ];
        }

        $response = new JsonModel(array(
            'response' => $response,
        ));
        return $response;
        
    }

    /** 
    * Função formata os dados para visualização
    * @access public 
    * @return Zend\View\Model\JsonModel 
    */ 
    public function viewAction() {

        $id = $this->params('id');
        $response = [];
        $header = '';

        $certificate = $this->resources->getCertificate($id);

        if ($certificate) {
            $certificate = json_decode($certificate);
            
            $parseFile = new X509();
            $detail = $parseFile->loadX509($certificate->certificate);
            
            $aux = $parseFile->getSubjectDN();
            $subjectDN = 'C=' . $aux['rdnSequence'][0][0]['value']['printableString'] . ', ' .
               'O=' . $aux['rdnSequence'][1][0]['value']['printableString'] . ', ' .
               'OU='. $aux['rdnSequence'][2][0]['value']['printableString'] . ', ' .
               'OU='. $aux['rdnSequence'][3][0]['value']['printableString'] . ', ' .
               'OU='. $aux['rdnSequence'][4][0]['value']['printableString'] . ', ' .
               'CN='. $aux['rdnSequence'][5][0]['value']['printableString'];

        
            $aux = $parseFile->getIssuerDN();
            $issuerDN =  'C=' . $aux['rdnSequence'][0][0]['value']['printableString'] . ', ' .
               'O=' . $aux['rdnSequence'][1][0]['value']['printableString'] . ', ' .
               'OU='. $aux['rdnSequence'][2][0]['value']['printableString'] . ', ' .
               'OU='. $aux['rdnSequence'][3][0]['value']['printableString'] . ', ' .
               'CN='. $aux['rdnSequence'][4][0]['value']['printableString'];

            $cert = [
            'notBefore' => date('M d H:i:s Y e', strtotime($detail['tbsCertificate']['validity']['notBefore']['utcTime'])),
            'notAfter'  => date('M d H:i:s Y e', strtotime($detail['tbsCertificate']['validity']['notAfter']['utcTime'])),
            'subjectDn' => $subjectDN,
            'issuerDn'  => $issuerDN,
            'name'      => $certificate->name
            ];

           $response = new JsonModel(array(
               'status' => 'ok',
               'data'   => $cert
            ));

        } else {

            $response = new JsonModel(array(
               'status' => 'fail',
               'message' => 'Erro ao buscar certificado' 
            ));

        }

        return $response;
    }

    /** 
    * Remove o certificado do banco
    * @access public 
    * @return Zend\View\Model\JsonModel 
    */ 
    public function deleteAction() {
        $certificado = $this->resources->delete($this->params('id'));
        $response = [];

        if ($certificado) {

            $response = new JsonModel(array(
                'status' => "ok",
                'message' => "Certificado excluído com sucesso."
            ));
 
        } else {

            $response = new JsonModel(array(
                'status' => "fail",
                'message' => "Error na exclusão do certificado"
            ));

        }
        return $response;
    }

    /** 
    * Altera os dados do certificado
    * @access public 
    * @return Zend\View\Model\JsonModel 
    */ 
    public function updateAction() {
        $data = $this->getRequest()->getPost()->toArray();

        $cert = [
            'name'        => $data['name'],
            'certificate' => $data['file'],
            'id'          => $this->params('id')
        ];

        $response = [];

        if ($this->resources->put($cert)) {

            $response = [
                'status' => 'ok',
                'message' => 'Certificado alterado com sucesso.'
            ];

        } else {
            $response = [
                'status' => 'ok',
                'message' => 'Erro ao alterar certificado. Tente novamente.'
            ];
        }

        $response = new JsonModel(array(
            'response' => $response,
        ));
        return $response;
    }
}
