<?php
namespace Application\Form;

use Application\Entity\Repositories\UtilsRepository;
//use Application\Helpers\Logger;
use Doctrine\ORM\EntityManager;
use Zend\Form\Element;
use Zend\Form\Form;

/**
 * 
 * Generador de Formularios con objetos Zend_Form
 * @author walvarez
 *
 */
class PlantillaForm extends Form{
	
	/**
	 * Construccion de formulario
	 * @param array $formularioParametros
	 * @param array $formObjValoresPersonalizados
	 * 		$formObjValoresPersonalizados = array (
							array ('name' => "name_object_1", 
								   'value' => "value_object_1" ),
							array ('name' => "name_object_2",
								   'value' => "value_object_1"),
							array(...),
						);
	 */

    private $em;

   	public function __construct ($formName, $options = array()){
   		
   		if(is_null($formName)){
   			return;
   		}

        parent::__construct($formName);

        $this->em = $options['em'];
        $useFilter = $options['use_filter'];

        $utilsRepository = new UtilsRepository($this->em);
        $formularioParametros = $utilsRepository->getFormularioParametros($formName);

		// Parametros del formulario
   		//$formularioParametros = $formularioParametros[0];
   		
  		$formParamId = $formularioParametros['id'];
		$action = $formularioParametros['accion'];
		$metodoEnvio = trim($formularioParametros['metodo']);
		$formNombre = $formularioParametros['form_name'];
		$tipoAccion = $formularioParametros['tipo_accion'];
		$autocomplete = $formularioParametros['autocomplete'];

		// Obteniendo los objetos del formulario de acuerdo a un parametro de entrada
	    $objetosFormulario = $utilsRepository->getFormularioObjetos($formParamId);
		    
   		// Definicion de la atributos del formulario (action, method, id, name)
	 	$this->setAttribute('action', $action)
	 		 ->setAttribute('method', $metodoEnvio)
	 		 ->setAttribute("id", $formNombre)
	 		 ->setAttribute("name", $formNombre)
	 		 ->setAttribute("autocomplete", $autocomplete)
	 		 ->setAttribute("role", "form")
            ->setAttribute("class", "form-horizontal");
	 		 //->setAttrib("onSubmit", "updateTreeMenu();return false;");
	 	
	 	//tipo decorators 

	 	// Generacion de los objetos del formulario
		foreach ($objetosFormulario as $objetoForm) {
			//Logger::logIntoFirebug($objetoForm);
			$label = $objetoForm['label'];
	        $name = $objetoForm['name'];
	        $objectType = $objetoForm['object_type'];
	        $nombreObjeto = $objetoForm['name'];
	        $errorMessage = $objetoForm['error_message'];
	        $required = $objetoForm['required'];
	        $size = $objetoForm['size'];
	        $order = $objetoForm['orden'];
	        $value = $objetoForm['value'];
	        $class = $objetoForm['class'];
	        $campos = $objetoForm['campos'];
	        $ondimamic = $objetoForm['ondimamic'];
	        $disabled = $objetoForm['disabled'];
	        $readonly = $objetoForm['readonly'];
	        $title = $objetoForm['title'];
	        $maxlength = $objetoForm['maxlength'];
	        $tipoValidacion = $objetoForm['tipo_validacion']; // para validacion de Expresiones Regulares
	        $placeholder = $objetoForm['placeholder']; 
	         
			// **** PERSONALIZACION
			/*$eventosDinamicosJavascript = array();
			if($ondimamic != null)
				$eventosDinamicosJavascript = explode("|",$ondimamic);
			else	
				$eventosDinamicosJavascript[0] = "";
				
			// Recuperando valores personalizados asignandos desde el parametro $paramsAux 	
			if(count($formObjValoresPersonalizados)>0){
				foreach ($formObjValoresPersonalizados as $objetoFormPersonalizado) {
					if( isset($objetoFormPersonalizado['name']) and $objetoFormPersonalizado['name'] == $name){
						$value = isset($objetoFormPersonalizado['value']) ? $objetoFormPersonalizado['value'] : $value;
						$readonly = isset($objetoFormPersonalizado['readonly']) ? strtoupper($objetoFormPersonalizado['readonly']) == "TRUE" ? TRUE: FALSE : $readonly;
						$campos = isset($objetoFormPersonalizado['campos']) ? $objetoFormPersonalizado['campos'] : $campos;
						$objectType = isset($objetoFormPersonalizado['objectType']) ? $objetoFormPersonalizado['objectType'] : $objectType;
						$size = isset($objetoFormPersonalizado['size']) ? $objetoFormPersonalizado['size'] : $size; 
						break;
					}
				}
			}*/

            /*
			// Filtros
			if($objectType == "textarea"){
				$filters = array();
			}else{
				//$filters = array('HtmlEntities', 'StripTags', 'StringTrim','Alnum');
				$filters = array('StripTags','StripNewlines');
			}*/
				
			// GENERACION DE OBJETOS DEL FORMULARIO ***************************
	        switch ($objectType) { 
	            case "text":
	            	unset($objetoText);
			        $objetoText = new Element\Text($name);

                    //\Zend_Form_Element_Text($name);
				    $objetoText->setLabel($label)
                        //->setLabelAttributes(array('class'=>'col-sm-2 control-label'))
				         //->setOptions(array('size' => $size))
				         //->setRequired($required)
						 //->setMessages(array($errorMessage))
					//if($tipoValidacion != null) $objetoText->addValidator($tipoValidacion); // Validacion
			        //$objetoText->addFilters($filters) // Filtros
				         ->setValue($value)
				         //->setOrder($order)
				         //->setAttribute('size', $size)
				         //->setAttribute('maxlength', $maxlength)
				         ->setAttribute('id', $name)
				         ->setAttribute('title', $title)
				         ->setAttribute('class', $class)
			        	 ->setAttribute('placeholder', $placeholder)
			        	 ->setAttribute('required', $required)
			        	 ->setAttribute('disabled', $disabled )
			        	 ->setAttribute('for', $label );
			        if($readonly) $objetoText->setAttribute('readonly', $readonly );
			        
				    //$this->setAtribTiposEventosJavaScript($objetoText, $eventosDinamicosJavascript);
				    //$this->setDecoratorsFormulario($objetoText,$tipoDecoratorObjeto);
					
				    $this->add($objetoText);

					break;

				case "textarea":
			        $aux = explode("|",$size);
			        $row = $aux[0];
			        $cols = $aux[1];

                    $objetoTextArea = new Element\Textarea($name);
					$objetoTextArea->setLabel($label)
                                   ->setValue($value)
                                    ->setAttribute('id', $name)
                                   ->setAttribute('rows', $row)
                                   ->setAttribute('cols', $cols)
 						           ->setAttribute('title', $title)
						           ->setAttribute('class', $class)
						           ->setAttribute('required', $class)
         		    			   ->setAttribute('disabled', $disabled)
                                   ->setAttribute('placeholder', $placeholder);
         		    if($readonly) $objetoTextArea->setAttribute('readonly', $readonly );
         		   
                   // $this->setAtribTiposEventosJavaScript($objetoTextArea, $eventosDinamicosJavascript);
				    $this->add($objetoTextArea);
	            	break;
	           case "password":
	            	unset($objetoPassword);
			        $objetoPassword = new Element\Password($name);
				    $objetoPassword->setLabel($label)
                        ->setAttribute('size', $size)
                        ->setAttribute('id', $name)
				        // ->setAttribute('maxlength', $maxlength)
				         ->setAttribute('title', $title)
				         ->setAttribute('class', $class)
                         ->setAttribute('required', $class)
				    	 ->setAttribute('placeholder', $placeholder)
				    	 ;
				    $this->add($objetoPassword);
					break;
	            case "hidden":
	            	unset($objetoHidden);
			        $objetoHidden = new Element\Hidden($name);

		            //$objetoHidden->setLabel($label)
		            $objetoHidden->setValue($value)
                                ->setLabel($label)
                             ->setAttribute('id', $name)
                            ->setAttribute('size', $size)
				           ->setAttribute('class', $class);
		           $this->add($objetoHidden);
		           
					break;
                 	case "select";

                        //$value = array("0"=>"Suspendido","1"=>"Vigente");
                        $objetoSelect = new Element\Select($name);
                        $objetoSelect->setLabel($label)
                                     //->messages($errorMessage)
                                     //->addMultiOption("","")
                                     ->setAttribute('title', $title)
                                     ->setAttribute('class', $class)
                                     ->setAttribute('required', $class)
                                     ->setAttribute('disabled', $disabled)
                                     ;
                                    //->setValueOptions(array(0=>"Suspendido",1=>"Vigente"));
                        $this->setMultiOptionForQueryOrArray($objetoSelect, $value, $campos);
                        //$this->setAtribTiposEventosJavaScript($objetoSelect, $eventosDinamicosJavascript);
                        $this->add($objetoSelect);
                        break;

                 /*   case "multiselect";
                        $objetoMultiSelect = new \Zend_Form_Element_Multiselect($name);
                        $objetoMultiSelect->setLabel($label)
                                     ->setRequired($required)
                                     ->addErrorMessage($errorMessage)
                                     ->setOrder($order)
                                     //->addMultiOption("","Seleccione...")
                                     ->setAttrib('title', $title)
                                     ->setAttrib('size', $size)
                                     ->setAttrib('class', $class)
                                     ->setAttrib('disabled', $disabled)
                                     ->setAttrib('required', $class);
                        $this->setMultiOptionForQueryWithDoctrine($objetoMultiSelect, $value, $campos);
                        //$this->setAtribTiposEventosJavaScript($objetoSelect, $eventosDinamicosJavascript);
                        $this->setDecoratorsFormulario($objetoMultiSelect,$tipoDecoratorObjeto);
                        $this->addElement($objetoMultiSelect);
                        break;

                    case "checkbox";
                        $objetoCheckbox = new \Zend_Form_Element_MultiCheckbox($name);
                        $objetoCheckbox->setLabel($label)
                                       ->setRequired($required)
                                       ->addErrorMessage($errorMessage)
                                       ->setOrder($order)
                                       ->setAttrib('class', $class)
                                       ->setAttrib('required', $class);
                        $this->setMultiOptionForQueryWithDoctrine($objetoCheckbox, $value, $campos);
                        $this->setAtribTiposEventosJavaScript($objetoCheckbox, $eventosDinamicosJavascript);
                        $this->setDecoratorsFormulario($objetoCheckbox,$tipoDecoratorObjeto);
                        $this->addElement($objetoCheckbox);
                        break;

                    case "captcha";
                        $objetoCaptcha = new \Zend_Form_Element_Captcha($name,array(
                                                'captcha' => array(
                                                'captcha' => 'Image',
                                                'wordLen' => $maxlength,
                                                'timeout' => 300,
                                                'width'   => 130,
                                                'height'  => 70,
                                                'imgUrl'  => '/../captcha',
                                                'imgDir'  => APPLICATION_PATH . '/../public/captcha',
                                                //'font'    => APPLICATION_PATH . '/../public/fonts/arialbi.ttf',
                                                'font'    => APPLICATION_PATH . '/../public/fonts/FjallaOne-Regular.ttf',
                                                'fontSize' => $size,
                                                )
                                            ));
                        $objetoCaptcha->setLabel($label)
                                       ->setRequired($required)
                                       ->addErrorMessage($errorMessage)
                                       ->setOrder($order)
                                       ->setAttrib('title', $title)
                                       ->setAttrib('class', $class)
                                       ->setAttrib('required', $class);
                        //$this->setAtribTiposEventosJavaScript($objetoCaptcha, $eventosDinamicosJavascript);
                        $this->setDecoratorsFormulario($objetoCaptcha,$tipoDecoratorObjeto);
                        $this->addElement($objetoCaptcha);
                        break;

                    case "file":
                        $this->setEnctype('multipart/form-data'); //setAttrib('enctype', 'multipart/form-data');
                         $objetoFile = new \Zend_Form_Element_File($name);
                        $objetoFile->setLabel($label)
                                   ->setRequired($required)
                                   ->addErrorMessage($errorMessage)
                                   ->setOrder($order)
                                   ->setDestination(APPLICATION_PATH_PUBLIC.$value)
                                   ->setAttrib('class', $class)
                                   ->setAttrib('disabled', $disabled)
                                   ->setAttrib('readonly', $readonly)
                                   ->setAttrib('required', $class);
                        $this->setDecoratorsFormulario($objetoFile,$tipoDecoratorObjeto);
                        $this->addElement($objetoFile);
                        break;
                    case "radio";
                        $objetoRadio = new \Zend_Form_Element_Radio($name);
                        $objetoRadio->setLabel($label)
                                    ->setRequired($required)
                                    ->addErrorMessage($errorMessage)
                                    ->setOrder($order)
                                    ->setAttrib('class', $class)
                                    ->setAttrib('disabled', $disabled)
                                    ->setAttrib('readonly', $readonly)
                                    ->setAttrib('required', $class);
                        $this->setMultiOptionForQueryWithDoctrine($objetoRadio, $value, $campos);
                        $this->addElement($objetoRadio);
                        $this->setDecoratorsFormulario($objetoRadio,$tipoDecoratorObjeto);
                        $this->setAtribTiposEventosJavaScript($objetoRadio, $eventosDinamicosJavascript);
                        break;	*/
	        } //end switch   
		} //end foreach
			
		// SEGURIDAD: Proteccion Cross Site Request Forgery (CSRF)
		//$this->addElement('hash','csrf_token',array('salt' => get_class($this).'s3cr3t%Ek@on9!'));
			
		// Definicion del boton submit
		//$cantidadElementos = count($objetosFormulario) + 1;
		$submit = new Element\Submit($tipoAccion);
    	$submit->setLabel($tipoAccion)
            ->setValue($tipoAccion)
            ->setAttribute('class', "btn btn-primary");
        		//->setOptions(array('class' => 'submit'));
				//->setOrder($cantidadElementos);
		/*$submit->setDecorators(array(
				'ViewHelper',
				array(array('data' => 'HtmlTag'), array('tag' => 'td', 'align' => 'right', 'colspan' => '2')),
				array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
		));
    	$submit->removeDecorator ( 'label' );*/
        $this->add($submit);

			// Boton Reset
//			$cantidadElementos++;
//		    $reset = new Zend_Form_Element_Reset('reset');
//		    $reset->setLabel('Cancelar')
//		    	  ->setOrder($cantidadElementos);	
//		    $this->addElement($reset);
	        
		// Definicion del tipo de Decorators del formulario
		/*switch ($tipoDecorator) {
			case "default":
				$this->setDecorators(array(
						'FormElements', 
						array('HtmlTag', array('tag' => 'dl',"style"=>"border: 1px solid #dddddd")), 
						'Form'
					));
				break;			
			case "table":
				$this->setDecorators(array(
						'FormElements',
						array('HtmlTag', array('tag' => 'table', 'border'=>'0')), //"style"=>"border: 0px solid #dddddd",
						'Form'
					));  
           		break;
           	case "viewScript":
           		$this->setDisableLoadDefaultDecorators(TRUE);
           		$this->setDecorators(array(
						array('ViewScript',		array('viewScript'=> $urlViewScript)),
						array('Description',	array ('placement' => 'prepend') ), 
						'Form'
					));
           		break;
		}*/
		
		//Logger::logIntoFirebug($this->getDecorators());

        if($useFilter){
            //$this->setInputFilter(new PlantillaFormFilter($formName, $options));
        }
    }
    
    /**
     * Setea el atributo "setDecorators" para determinar el decorator del objeto recibido
     * @param $objeto
     * @param $tipoDecorator
     */
    private function setDecoratorsFormulario($objeto, $tipoDecorator) {
    	
    	 
    	switch ($tipoDecorator) {
    		case "default":
//     			$objeto->setDecorators(
// 	    			array(
// 		    			'ViewHelper',
// 		    			'Errors',
// 		    			array(array('data'=>'HtmlTag'), array('tag' => 'dd',"style"=>"border: 1px dashed #dddddd")),
// 		    			array('Label', array('tag' => 'dt')),
//     				));
    			break;    		
    		case "table":
    			$objeto->setDecorators(
    				array(
    						'ViewHelper',
    						'Description',
    						'Errors', 
    						array(array('data'=>'HtmlTag'), array('tag' => 'td')), //,"style"=>"border: 0px solid #dddddd"
    						array('Label', array('tag' => 'td','class' => '')),
    						array('Errors', array('tag' => 'td')),
    						array(array('row'=>'HtmlTag'),array('tag'=>'tr', 'valign'=>'top'))
    			));
    			
    			if($objeto->getType() == "Zend_Form_Element_Captcha"){
    				$objeto->setDecorators (array(
    						'Captcha',
    						'Description',
    						'Errors',
							array (array ('data' => 'HtmlTag'),array ('tag' => 'td')),
							array ('Label',array ('tag' => 'td')),
							array (array ('row' => 'HtmlTag'),array ('tag' => 'tr', 'valign'=>'top'))
					));
    			}
    			
    			if($objeto->getType() == "Zend_Form_Element_Hidden"){
					$objeto->removeDecorator('label');
					$objeto->removeDecorator('DtDdWrapper');
    			}
    			break;
    			
    		case "viewScript":
    			$objeto->setDecorators(array(
    					'ViewHelper',
    					//'Label',  // TODO verificar si es funcional para todos los formularios
    					'Description',
    					'Errors',
    					//'HtmlTag'
    					//array(array('data'=>'HtmlTag'), array('tag' => 'div')), //,"style"=>"border: 0px solid #dddddd"
    					//array('Label', array('tag' => 'div','class' => '')),
    					//array('Errors', array('tag' => 'div')),
    					//array(array('row'=>'HtmlTag'),array('tag'=>'tr'))
    				));
    			
    			if($objeto->getType() == "Zend_Form_Element_Captcha"){
    				$objeto->setDecorators (array(
    						//'Captcha',
    						//'Label',  // TODO verificar si es funcional para todos los formularios
    						'Description',
    						'Errors',
    						//array (array ('data' => 'HtmlTag'),array ('tag' => 'span')),
    						//array ('Label',array ('tag' => 'span')),
    						//array (array ('row' => 'HtmlTag'),array ('tag' => 'div'))
    				));
    			}
    			    			
    			break;
    	}
    }    
    
    /**
     * Setea (carga) el atributo "addMulti  Option" con un SqlQuery del objeto recibido
     * @param $objeto
     * @param $sqlQuery
     * @param $campos
     */
    private function setMultiOptionForQueryOrArray($objeto, $value, $campos){
    	
    	if(is_array($value)){
            $objeto->setValueOptions($value);
    	}else{
    		if($value != "" and $campos != "" ){
    			$sqlQuery = $value; 
    			$result = array();
    			$campoAux = explode("|", $campos);

                $utilsRepository = new UtilsRepository($this->em);
                $result = $utilsRepository->execNativeSql($sqlQuery);

    			//$result = UtilsRepository::getInstance()->execNativeSql($sqlQuery);
                $options = array(""=>"-- Seleccione una opción --");
    			foreach ($result as $value) {
    				//$objeto->addMultiOption($value[$campoAux[0]], $value[$campoAux[1]]);
                    $options[$value[$campoAux[0]]] = $value[$campoAux[1]];
    			}
                $objeto->setValueOptions($options);
    		}
    	}
    }
    
    /**
     * Setea (carga) el atributo "setAttrib" con eventos JavaScript al objeto recibido
     * @param $objeto
     * @param $eventosDinamicosJavascript
     */
    private function setAtribTiposEventosJavaScript($objeto, $eventosDinamicosJavascript = array()){
    	unset($resultado);
    	$resultado = array();
    	if($eventosDinamicosJavascript[0] != ""){
	    	for ($i = 0; $i < count($eventosDinamicosJavascript); $i++) {
	         	$eventoJavascript = explode("_", $eventosDinamicosJavascript[$i]);
	        	$tipoEventoJavaScript = $eventoJavascript[0]; 
	        	$funcionEventoJavaScript = $eventoJavascript[1];
	        			 	
	        	switch ($tipoEventoJavaScript) {
	        		case "onblur":
	        			$tipoevento = "onBlur";
	        		    break;
	        		case "onclick":
	        			$tipoevento = "onClick";
	        			break;
					case "onkeyup":
	        			$tipoevento = "onkeyup";
	        			break;	        			
	        		case "":
	        			$tipoevento = ""; // TODO Aumentar mas eventos si esque asi esta definido en la BD
	        			break;
	        	}
	        	$objeto->setAttrib($tipoevento, $funcionEventoJavaScript);
	        }
    	}
    }
}
?>
