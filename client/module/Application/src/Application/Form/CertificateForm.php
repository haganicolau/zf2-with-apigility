<?php

/**
 * Class responsável por criar o formulário
 * @author Hagamenon <haganicolau@gmail.com>
 * @version 0.1 
 * @package Application\Form
 */
namespace Application\Form;

/*Dependências*/
use Zend\Form\Form;
use Zend\InputFilter;
use Zend\Form\Element;
use Zend\Form\ZendX_JQuery_Form;

class CertificateForm extends Form {

    /**
     * 
     * @param $name
     * @param $array
     * @return void
     */
    public function __construct($name = null, $options = array()) {
        parent::__construct($name, $options);

        $this->addElements();
        $this->addInputFilter();
    }

    /**
     * 
     * @return void
     */
    public function addElements() {
        $nome = new Element\Text('name');
        $nome->setAttribute('class', 'form-control')
                ->setLabel('Nome')
                ->setAttribute('id', 'name');
        $this->add($nome);

        $certificado = new Element\File('certificate');
        $certificado->setAttribute('class', 'form-control')
                ->setLabel('Certificado')
                ->setAttribute('id', 'certificate');
        $this->add($certificado);

        $this->setAttribute('action', '/create');
        $this->setAttribute('enctype', 'multipart/form-data');
    }

    /**
     * 
     * @return void
     */
    public function addInputFilter() {
        $inputFilter = new InputFilter\InputFilter();

        $nomeInput = new InputFilter\Input('name');
        $nomeInput->setRequired(true);

        $certificadoInput = new InputFilter\FileInput('certificate');
        $certificadoInput->setRequired(true);

        $inputFilter->add($certificadoInput)->add($nomeInput);

        $this->setInputFilter($inputFilter);
    }

}
