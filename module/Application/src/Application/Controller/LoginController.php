<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Application\Entity\Repositories\PeiRepository;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class LoginController extends BaseController
{
    public function indexAction()
    {
        $layout = $this->layout('layout/layout-login');
        // $layout->setTemplate('layout/layoutlogin');
        /*$viewModel = new ViewModel();
        return $viewModel;*/
        //return new ViewModel(array("res"=>""));



        $param = $this->params()->fromRoute(); //GET
        //$param = $this->getRequest()->query(); //GET

        //$request = $this->getRequest();
         //\Zend\Debug\Debug::dump($param,'request - ',true);
        $errorEnFormulario = false;

        $post = $this->request->getPost();
        //$form->setData($post);

        $respuesta = array("respuesta" => false, "mensaje" => '', "errores"=>"");

        if (!$this->request->isPost()) {
            return new ViewModel(array("error_en_formulario"=>$errorEnFormulario,"mensaje_respuesta"=>$respuesta));
        }

        $post = $this->request->getPost()->toArray();
        \Zend\Debug\Debug::dump($post);


        return $this->redirect()->toRoute('application');


        /*if($form->isValid()){

            $respuesta = array("respuesta" => true, "mensaje" => "SUCCESS.", "errores"=>"");
            //return new ViewModel(array("form"=>$form,"error_en_formulario"=>$errorEnFormulario,"mensaje_respuesta"=>$respuesta));
            return $this->redirect()->toRoute('formulacion/default',array("controller"=>"test","action"=>"formulario","param-1"=>"Matias"));
            //return $this->redirect()->toRoute('formulacion/test',array("action"=>"formulario"));

        }else{

            $errorEnFormulario = true;
            $errores = "";//$form->getMessages();
            $respuesta = array("respuesta" => false, "mensaje" => "Existen errores en el formulario. Verifique por favor.", "errores"=>$errores);
        }*/

        return new ViewModel(array("error_en_formulario"=>$errorEnFormulario,"mensaje_respuesta"=>$respuesta));




    }


}
