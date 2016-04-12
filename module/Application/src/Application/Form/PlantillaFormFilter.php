<?php
namespace Application\Form;

use Application\Entity\Repositories\UtilsRepository;
use Zend\Filter\StripTags;
use Zend\InputFilter\InputFilter;
use Zend\Validator\EmailAddress;
use Zend\Validator\NotEmpty;
use Zend\Validator\StringLength;

class PlantillaFormFilter extends InputFilter
{
    public function __construct($formName, $options = array())
    {

        if(is_null($formName)){
            return;
        }

        $this->em = $options['em'];
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

echo $name . "/".$required ."<br/>";
           // StringTrim:::  \eqweqwe"ss"s
            //***************************************************************************************
        $this->add(array(
            'name'       => "$name",
            'required'   => $required,
            'filters'    => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
                //array('name' => 'StripNewlines'),
            ),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'options' => array(
                        'messages' => array(
                            NotEmpty::IS_EMPTY => $errorMessage,
                        ),
                    ),
                ),
               /* array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min'      => 1,
                        'max'      => 500,
                    ),
                ),*/
                /*array(
                    'name'    => 'StringLength',
                    'options' => array(
                        //'encoding' => 'UTF-8',
                        //'min'      => 2,
                        //'max'      => 10,
                        //'messages' => array(
                         //   StringLength::TOO_LONG => 'No debe superar las de 10 caracteres.',
                         //   StringLength::TOO_SHORT => 'Debe ser mayor a 2 caracteres.',
                        //),
                    ),
                ),
                array(
                    'name'    => 'EmailAddress',
                    'options' => array(
                        'domain' => true,
                        'messages' => array(
                            EmailAddress::INVALID => 'Hostname no valido...',
                            EmailAddress::INVALID_HOSTNAME => 'Hostname no valido 222222...',
                           // StringLength::TOO_SHORT => 'Debe ser mayor a 2 caracteres.',
                        )
                    ),
                ),*/
            ),
        ));

        }

    }
}
