<?php
namespace AuthDoctrine\Form;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\Validator\NotEmpty;
use Zend\Validator\StringLength;

class LoginFilter extends InputFilter
{
	public function __construct($sm)
	{
		// self::__construct(); // parnt::__construct(); - trows and error
		$this->add(array(
			'name'     => 'username', // 'usr_name'
			'required' => true,
			'filters'  => array(
				array('name' => 'StripTags'),
				array('name' => 'StringTrim'),
			),
			'validators' => array(
				array(
						'name' => 'NotEmpty',
						'options' => array(
								'messages' => array(
										NotEmpty::IS_EMPTY => "Usuario requerido",
								),
						),
				),
				array(
					'name'    => 'StringLength',
					'options' => array(
						'encoding' => 'UTF-8',
						'min'      => 6,
						//'max'      => 100,
                        'messages' => array(
                            StringLength::TOO_SHORT => "Caracteres de al menos 6 caracteres.",
                        ),
					),
				),
				/*array(
					'name'		=> 'DoctrineModule\Validator\ObjectExists',
					'options' => array(
						'object_repository' => $sm->get('doctrine.entitymanager.orm_default')->getRepository('AuthDoctrine\Entity\Usuario'),
						'fields'            => 'usrName'
					),
					
				),*/
			), 
		));
		
		$this->add(array(
			'name'     => 'password', // usr_password
			'required' => true,
			'filters'  => array(
				array('name' => 'StripTags'),
				array('name' => 'StringTrim'),
			),
			'validators' => array(
				array(
						'name' => 'NotEmpty',
						'options' => array(
								'messages' => array(
										NotEmpty::IS_EMPTY => "Clave requerido",
								),
						),
				),
				array(
					'name'    => 'StringLength',
					'options' => array(
						'encoding' => 'UTF-8',
						'min'      => 4,
						'max'      => 20,
						'messages' => array(
							StringLength::TOO_SHORT => "Clave de al menos 6 caracteres.",
							StringLength::TOO_LONG => "Clave no debe ser mas de 20 caracteres.",
						)
					),
				),
			),
		));

		$this->add(array(
			'name'     => 'rememberme', // rememberme
			'required' => false,
		));

		$this->add(array(
			'name'     => 'aplicaciones', // aplicaciones
			'required' => false,
		));
	}
}