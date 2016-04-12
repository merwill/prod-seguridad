<?php

class Application_Form_LoginForm extends \Zend_Form {
	
	public function init() {
		$this->setDisableLoadDefaultDecorators ( true );
		
		//$this->setAction("/admin/index");
		
		$this->setDecorators ( array (
				array (
						'ViewScript',
						array (
								'viewScript' => 'index/_login.phtml' 
						) 
				),
				array (
						'Description',
						array (
								'placement' => 'prepend' 
						) 
				),
				'Form' 
		) );
		$this->setAttrib ( 'id', 'login' );
		$username = $this->addElement ( 'text', 'username', array (
				'filters' => array (
						'StringTrim',
						'StringToLower' 
				),
				'placeholder' => 'Usuario',
				'autofocus' => 'autofocus', // 1 required
				'validators' => array (
						'Alpha',
						array (
								'StringLength',
								false,
								array (
										3,
										20 
								) 
						) 
				),
				'required' => true,
				'label' => 'Usuario:' 
		) );
		$this->username->setAttrib ( 'required', 'required' );
		$password = $this->addElement ( 'password', 'password', array (
				'filters' => array (
						'StringTrim' 
				),
				'placeholder' => 'Contraseña',
				'validators' => array (
						'Alnum',
						array (
								'StringLength',
								false,
								array (
										3,
										20 
								) 
						) 
				),
				'required' => true,
				'label' => 'Contraseña:' 
		) );
		$this->password->setAttrib ( 'required', 'required' );
		
// 		$login = $this->addElement ( 'submit', 'login', array (
// 				'required' => false,
// 				'ignore' => true,
// 				'label' => 'Ingresar' 
// 		) );
		
		$login = $this->addElement ( 'submit', 'submit', array (
				'required' => false,
				'ignore' => true,
				'label' => 'Ingresar' 
		) );
		
		$this->setElementDecorators ( array (
				'ViewHelper' 
		) );
	}
}