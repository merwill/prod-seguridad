<?php
namespace AuthDoctrine\Form;

use Zend\Form\Element;
use Zend\Form\Form;

class CambiarPasswordForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('registration');
        $this->setAttribute('method', 'post');
        $this->setAttribute('role', 'form');
        $this->setAttribute('class', 'form-horizontal');
        //$this->setAttribute('onsubmit' , 'if(!confirm("Seguro de guardar?")){return false;}else{validar();}');
        $this->setAttribute('onsubmit', 'if(!confirm("Seguro de guardar?")){return false;}');




        $this->add(array(
            'name' => 'usrName',
            'attributes' => array(
                'type'  => 'text',
                'id' => 'usrName',
               // 'title' => 'Usuario-title',
                'class' => 'form-control',
                'required' => 'required',
                'placeholder' => 'Ingrese Usuario...',
                'for' => 'Usuario',
            ),
            'options' => array(
                'label' => 'Usuario',
            ),
        ));

        $this->add(array(
            'name' => 'usrEmail',
            'attributes' => array(
                'type'  => 'email',
                //'id' => 'usrEmail',
               // 'title' => 'Usuario-title',
                'class' => 'form-control',
               // 'required' => 'required',
                'placeholder' => 'Ingrese Correo...',
                'for' => 'Correo',
            ),
            'options' => array(
                'label' => 'Correo',
            ),
        ));

       /*/ $objetoText = new Element\Email('usrEmail');

        $objetoText->setLabel('Correo')
           // ->setValue($value)
           // ->setAttribute('id', 'usrEmail')
            ->setAttribute('title', 'Usuario-title')
            ->setAttribute('class', 'form-control')
            ->setAttribute('placeholder', 'Ingrese Usuario222...')
            //->setAttribute('required', $required)
            ->setAttribute('disabled', false )
            ->setAttribute('for', 'Correo' );

        $this->add($objetoText);
*/
        $this->add(array(
            'name' => 'usrPasswordOld',
            'attributes' => array(
                'type'  => 'password',
                'class' => 'form-control',
                'placeholder' => 'Ingrese su clave...',
            ),
            'options' => array(
                'label' => 'Clave Actual',
            ),
        ));

		$this->add(array(
            'name' => 'usrPassword',
            'attributes' => array(
                'type'  => 'password',
                'class' => 'form-control',
                'placeholder' => 'Ingrese nueva clave...',
            ),
            'options' => array(
                'label' => 'Clave Nueva',
            ),
        ));

        $this->add(array(
            'name' => 'usrPasswordConfirm',
            'attributes' => array(
                'type'  => 'password',
                'class' => 'form-control',
                'placeholder' => 'Confirmar nueva clave...',
            ),
            'options' => array(
                'label' => 'Confirmar Clave:',
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'class' => 'btn btn-primary',
                'value' => 'Go',
                'id' => 'submitbutton',
                //'onclick' => "alert('hola')",
            ),
        )); 
    }
}