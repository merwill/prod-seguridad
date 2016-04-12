<?php
namespace AuthDoctrine\Form;

use Zend\Form\Form;

class RegistrationForm extends Form
{
    public function __construct($urlcaptcha = null)
    {
        parent::__construct('registration');
        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'usrName',
            'attributes' => array(
                'type'  => 'text',
            	'class' => 'form-control'
            ),
            'options' => array(
                'label' => 'Usuario',
            ),
        ));
		
        $this->add(array(
            'name' => 'usrEmail',
            'attributes' => array(
                'type'  => 'email',
           		'class' => 'form-control'
            ),
            'options' => array(
                'label' => 'Correo Electrónico',
            ),
        ));	
		
        $this->add(array(
            'name' => 'usrPassword',
            'attributes' => array(
                'type'  => 'password',
				'class' => 'form-control'            		
            ),
            'options' => array(
                'label' => 'Clave',
            ),
        ));
		
        $this->add(array(
            'name' => 'usrPasswordConfirm',
            'attributes' => array(
                'type'  => 'password',
           		'class' => 'form-control'
            ),
            'options' => array(
                'label' => 'Confirmar Clave',
            ),
        ));	

// 		$this->add(array(
// 			'type' => 'Zend\Form\Element\Captcha',
// 			'name' => 'captcha',
// 			'options' => array(
// 				'label' => 'Ingrese Código de Seguridad',
// 				'captcha' => new \Zend\Captcha\Dumb(),
// 			),
// 		));
		
        $dirdataFont = './data';
        $dirdata = './public';
        $urlcaptcha = "/captcha/";
        
        //pass captcha image options
        $captchaImage = new \Zend\Captcha\Image( array(
        		'font' => $dirdataFont . '/fonts/tahoma.ttf',
        		'wordLen' => 4,
        		'width' => 250,
        		'height' => 100,
        		'dotNoiseLevel' => 40,
        		'lineNoiseLevel' => 3)
        );
        $captchaImage->setImgDir($dirdata.'/captcha');
        $captchaImage->setImgUrl($urlcaptcha);
        
		$this->add(array(
			'type' => 'Zend\Form\Element\Captcha',
			'name' => 'captcha',
			'attributes' => array(
					'class' => 'form-control'
			),
			'options' => array(
				'label' => 'Ingrese Código de Seguridad:',
				'captcha' => $captchaImage,
			),
		));
		

		
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Go',
                'id' => 'submitbutton',
           		'class' => 'btn btn-primary'
            ),
        )); 
    }
}