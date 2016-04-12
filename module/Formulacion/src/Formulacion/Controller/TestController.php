<?php

namespace Formulacion\Controller;

use Application\Controller\BaseController;
use Application\Entity\Repositories\UtilsRepository;
use Application\Form\PlantillaForm;
use Application\Form\PlantillaFormFilter;
use Doctrine\ORM\EntityManager;
use Zend\Json\Json;
use Zend\View\Model\ViewModel;

class TestController extends BaseController
{

    public function indexAction()
    {
        //return new ViewModel();
        //return $this->redirect()->toRoute('formulacion/test/test');



        $datosAction = array("module"=>"Formulacion","controller"=>"Test","action"=>"index");




        $formWidget = $this->forward()->dispatch('Formulacion\Controller\Test',
            array(
                'action' => 'formulario',
                'nombre'     => "Wilmercito",
                'app'     => "ALva",
                'apm'     => "Mamani",
            ));


        $viewModel = new ViewModel($datosAction);
       // $viewModel->
        return $viewModel->addChild($formWidget, 'formWidget');


    }

    public function formularioAction()
    {
        //$this->params()->fromPost('paramname');   // From POST
        //$this->params()->fromQuery('paramname');  // From GET
        //$this->params()->fromRoute('paramname');  // From RouteMatch
        //$this->params()->fromHeader('paramname'); // From header
        //$this->params()->fromFiles('paramname');  // From file being uploaded


        $param = $this->params()->fromRoute(); //GET
        //$param = $this->getRequest()->query(); //GET

        //$request = $this->getRequest();
       // \Zend\Debug\Debug::dump($param,'request - ',true);
        $errorEnFormulario = false;

        $options = array("em"=>$this->getEntityManager(),
                         "use_filter" => true);
        $form = new PlantillaForm("formInsumo", $options);

        $post = $this->request->getPost();
        $form->setData($post);

        $respuesta = array("respuesta" => false, "mensaje" => '', "errores"=>"");

        if (!$this->request->isPost()) {
        	$viewModel = new ViewModel(array("form"=>$form,"error_en_formulario"=>$errorEnFormulario,"mensaje_respuesta"=>$respuesta));
        	$viewModel->setTerminal(false);
        	return $viewModel;
        	 
        	
            //return new ViewModel(array("form"=>$form,"error_en_formulario"=>$errorEnFormulario,"mensaje_respuesta"=>$respuesta));
        }

        $post = $this->request->getPost()->toArray();
        if($form->isValid()){

            $respuesta = array("respuesta" => true, "mensaje" => "SUCCESS.", "errores"=>"");
            //return new ViewModel(array("form"=>$form,"error_en_formulario"=>$errorEnFormulario,"mensaje_respuesta"=>$respuesta));
            return $this->redirect()->toRoute('formulacion/default',array("controller"=>"test","action"=>"formulario","param-1"=>"Matias"));
            //return $this->redirect()->toRoute('formulacion/test',array("action"=>"formulario"));

        }else{

            $errorEnFormulario = true;
            $errores = "";//$form->getMessages();
            $respuesta = array("respuesta" => false, "mensaje" => "Existen errores en el formulario. Verifique por favor.", "errores"=>$errores);
        }

        return new ViewModel(array("form"=>$form,"error_en_formulario"=>$errorEnFormulario,"mensaje_respuesta"=>$respuesta));

    }

}
