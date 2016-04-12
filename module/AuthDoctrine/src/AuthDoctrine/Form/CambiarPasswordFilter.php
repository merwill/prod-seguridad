<?php
namespace AuthDoctrine\Form;


use DoctrineModule\Validator\NoPassDuplex;
use DoctrineModule\Validator\ObjectExists;
use Zend\InputFilter\InputFilter;
use Zend\Validator\Hostname;
use Zend\Validator\Identical;
use Zend\Validator\NotEmpty;
use Zend\Validator\StringLength;

class CambiarPasswordFilter extends InputFilter
{
	public function __construct($sm)
	{   //$n = new EmailAddress()

		$this->add(array(
			'name'       => 'usrName',
			'required'   => true,
			'validators' => array(
				array(
					'name'    => 'StringLength',
					'options' => array(
						'encoding' => 'UTF-8',
						'min'      => 6,
						'max'      => 50,
						'messages' => array(
							StringLength::TOO_SHORT=> 'La entrada es menos de %min% caracteres',
							StringLength::TOO_LONG=> 'La entrada es mas de %max% caracteres',
						),
					),
				),
				array(
					'name' => 'NotEmpty',
					'options' => array(
						'messages' => array(
							NotEmpty::IS_EMPTY => "Se requiere valor y no puede estar vacío",
						),
					),
				),
				array(
					'name'		=> 'DoctrineModule\Validator\ObjectExists',
					'options' => array(
						'object_repository' => $sm->get('doctrine.entitymanager.orm_default')->getRepository('Application\Entity\Usuario'),
						'fields'            => 'usrName',
						'messages' => array(
							ObjectExists::ERROR_NO_OBJECT_FOUND => "No se ha encontrado ningún objeto coincidente con '%value%'"
						),
					),
				),
			),
		));

/*		$this->add(array(
			'name'       => 'usrEmail',
			'required'   => true,
			'validators' => array(
				array(
					'name' => 'EmailAddress',
					'options' => array(
						'messages' => array(
							EmailAddress::INVALID_FORMAT=> 'La entrada no es una dirección válida de correo electrónico. Utilice el formato básico correo@dominio',
						),
					),
				),
				array(
					'name' => 'NotEmpty',
					'options' => array(
						'messages' => array(
							NotEmpty::IS_EMPTY => "Se requiere valor y no puede estar vacío",
						),
					),
				),
				array(
					'name'		=> 'DoctrineModule\Validator\ObjectExists',
					'options' => array(
						'object_repository' => $sm->get('doctrine.entitymanager.orm_default')->getRepository('Application\Entity\Usuario'),
						'fields'            => 'usrEmail',
						'messages' => array(
							ObjectExists::ERROR_NO_OBJECT_FOUND => "No se ha encontrado ningún objeto coincidente con '%value%'"
						),
					),
				),
			),
		));*/

		$this->add(array(
			'name'     => 'usrPasswordOld',
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
							 NotEmpty::IS_EMPTY => "Se requiere valor y no puede estar vacío",
						),
					),
				),
				array(
					'name'    => 'StringLength',
					'options' => array(
						'encoding' => 'UTF-8',
						'min'      => 6,
						'max'      => 15,
						'messages' => array(
							StringLength::TOO_SHORT=> 'La entrada es menos de %min% caracteres',
							StringLength::TOO_LONG=> 'La entrada es mas de %max% caracteres',
						),
					),
				),
			),
		));

		$this->add(array(
			'name'     => 'usrPassword',
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
							 NotEmpty::IS_EMPTY => "Se requiere valor y no puede estar vacío",
						),
					),
				),
				array(
					'name' => 'AuthDoctrine\Validator\MiValidadorPassword',

				),
				/*array(
					'name' => 'PasswordStrengthValidator',
					'options' => array(
						'messages' => array(
							PasswordStrength::UPPER => "'%value%' debe contener al menos una letra mayúscula",
						),
					),
				),*/
				array(
					'name'    => 'StringLength',
					'options' => array(
						'encoding' => 'UTF-8',
						'min'      => 8,
						'max'      => 15,
						'messages' => array(
							StringLength::TOO_SHORT=> 'La entrada es menos de %min% caracteres',
							StringLength::TOO_LONG=> 'La entrada es mas de %max% caracteres',
						),
					),
				),
				/*array(
					'name'		=> 'DoctrineModule\Validator\NoPassDuplex',
					'options' => array(
						'object_repository' => $sm->get('doctrine.entitymanager.orm_default')->getRepository('Application\Entity\Usuario'),
						'fields'            => 'usrName',
						'token' => 'usrPasswordOld',
						'messages' => array(
							NoPassDuplex::ERROR_NO_OBJECT_FOUND => "Password no debe ser igual '%value%'"
						),
					),
				),*/
			),
		));

		$this->add(array(
			'name'     => 'usrPasswordConfirm',
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
							NotEmpty::IS_EMPTY => "Se requiere valor y no puede estar vacío",
						),
					),
				),
				array(
					'name'    => 'StringLength',
					'options' => array(
						'encoding' => 'UTF-8',
						'min'      => 8,
						'max'      => 15,
						'messages' => array(
							StringLength::TOO_SHORT=> 'La entrada es menos de %min% caracteres',
							StringLength::TOO_LONG=> 'La entrada es mas de %max% caracteres',
						),
					),
				),
				array(
					'name'    => 'Identical',
					'options' => array(
						'token' => 'usrPassword',
						'messages' => array(
							//Identical::NOT_SAME=> 'Las campos no coinciden',
							Identical::NOT_SAME=>'Este campo no coincide con la clave nueva',
						),
					),
				),

			),
		));
	}
}