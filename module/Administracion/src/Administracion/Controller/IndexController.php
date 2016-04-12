<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonModule for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Administracion\Controller;


use Application\Controller\BaseController;
use Application\Entity\Repositories\ClaTablasParametricasRepository;
use Application\Entity\Repositories\ClaSectorEntidadRepository;
use DoctrineModule\Paginator\Adapter\Selectable as SelectableAdapter;
use Doctrine\Common\Collections\Criteria;
use Zend\Debug\Debug;
use Zend\Paginator\Paginator;
use Zend\Json\Json;
use Zend\Validator\Explode;
use Zend\View\Model\ViewModel;
use Application\Form\PlantillaForm;
use Application\Form\PlantillaFormFilter;
use Zend\Session\Container;


class IndexController extends BaseController
{
    public function indexAction()
    {
    	//$this->params()->fromPost('paramname');   // From POST
    	//$this->params()->fromQuery('paramname');  // From GET
    	//$this->params()->fromRoute('paramname');  // From RouteMatch
    	//$this->params()->fromHeader('paramname'); // From header
    	//$this->params()->fromFiles('paramname');  // From file being uploaded
    	$em = $this->getEntityManager();
    	$ClaTablasParametricasRepository = new ClaTablasParametricasRepository($this->getEntityManager());
    	$tablas = $ClaTablasParametricasRepository->findOrdenarPorNombre();
    	return array(
            'tablas'=>$tablas,   			
    	);
    }

    public function enviarAction()
    {
        $id = $this->params()->fromRoute('id',$this->params()->fromQuery('id','0'));
        
        $paramsContainer = new Container('params');
        $paramsContainer->id = $id;
        
        $em = $this->getEntityManager();
        $tabla = $em->getRepository('Application\Entity\ClaTablasParametricas')->find($id);
       //Debug::dump($tabla);
      	return $this->redirect()->toRoute($tabla->getModule(),array('controller'=>$tabla->getController(),'action'=>$tabla->getAction(),'id'=>$tabla->getId()));
        
    }
    
    public function eliminarAction()
    {
        $id = $this->params()->fromRoute('id',$this->params()->fromQuery('id','0'));
        $paramsContainer = new Container('params');
        if ( $paramsContainer->offsetExists('id') )
            $clase_id = $paramsContainer->offsetGet('id');
        $ClaTablasParametricasRepository = new ClaTablasParametricasRepository($this->getEntityManager());
    	$respuesta = $ClaTablasParametricasRepository->remove($id,$clase_id);
        echo Json::encode($respuesta);
	exit;
    }
    
    public function cambiarestadoAction()
    {
        $id = $this->params()->fromRoute('id',$this->params()->fromQuery('id','0'));
        $paramsContainer = new Container('params');
        if ( $paramsContainer->offsetExists('id') )
            $clase_id = $paramsContainer->offsetGet('id');
        $ClaTablasParametricasRepository = new ClaTablasParametricasRepository($this->getEntityManager());
    	$respuesta = $ClaTablasParametricasRepository->changestate($id,$clase_id);
        echo Json::encode($respuesta);
	exit;
    }

    public function parametricaAction()
    {
    	$request = $this->getRequest();
    	$viewmodel = new ViewModel();
    	$viewmodel->setTerminal($request->isXmlHttpRequest());
    	//id de la tabla parametrica    	
    	//$id = $this->params()->fromRoute('id',$this->params()->fromQuery('id','0'));
        $paramsContainer = new Container('params');
        //$paramsContainer->id = $id;
        if ( $paramsContainer->offsetExists('id') )
            $id = $paramsContainer->offsetGet('id');
        
        
      
    	//obtenemos los datos de la tabla parametrica
    	$em = $this->getEntityManager();
    	$tabla = $em->getRepository('Application\Entity\ClaTablasParametricas')->find($id);
    	//nombre de la clase para obtener la lista
    	
    	$clase = $tabla->getClase();
        //$clase = "Application\\Entity\\".$clase;
        //Debug::dump($clase);exit();
    	//cabecera de la lista
    	$cabecera = explode("|", $tabla->getColumn());
    	//valores de la lista
    	$dato = explode("|", $tabla->getData());
    	//generar la paginacion
        $criteria = Criteria::create()->orderBy(array("id" => Criteria::DESC));
    	$adapter = new SelectableAdapter($em->getRepository($clase),$criteria); 
    	$page = 1;
    	
    	
     	//$page = $this->params()->fromRoute();
     	//var_dump($page);
     	$page = $this->params()->fromRoute('page',$this->params()->fromQuery('page','1'));
//     	echo $page;
    	//if($this->params()->fromQuery('page')) $page = $this->params()->fromQuery('page');
    	//var_dump((int)$page);
    	$listado = new Paginator($adapter);
    	$listado->setCurrentPageNumber((int)$page)
    	->setItemCountPerPage($tabla->getPage());
		//enviar las variablea a lista
    	$viewmodel->setVariables(array(
    			'tabla'=>$tabla,
    			'listado'=>$listado,
    			'page' => $page,
    			'id' => $id,
    			'cabecera' => $cabecera,
    			'dato' => $dato,
    	));
    	 
    	return $viewmodel;

    }
    
    public function nuevoAction()
    {
    	$request = $this->getRequest();
    	$viewmodel = new ViewModel();
    	$viewmodel->setTerminal($request->isXmlHttpRequest());
        
        $paramsContainer = new Container('params');
        //$paramsContainer->id = $id;
        if ( $paramsContainer->offsetExists('id') )
            $id = $paramsContainer->offsetGet('id');
        else
            $id = 0;
    	//$id = $this->params()->fromRoute('id',$this->params()->fromQuery('id','0'));
        $em = $this->getEntityManager();
    	$tabla = $em->getRepository('Application\Entity\ClaTablasParametricas')->find($id);
    	//Generar Formulario
    	$errorEnFormulario = false;
    	$options = array("em"=>$this->getEntityManager(),"use_filter" => true);
    	$form = new PlantillaForm($tabla->getFormName(), $options);
    	if (!$this->request->isPost()) {
            $viewmodel->setVariables(array(
                    'tabla'=>$tabla,
                    "form"=>$form,
                    "error_en_formulario"=>$errorEnFormulario,
            ));
            return $viewmodel;
    	}
    	$post = $this->request->getPost()->toArray();
        unset($post['Registrar']);
        $form->setData($post);
    	if($form->isValid()){
            $SaveDataRepository = new ClaTablasParametricasRepository($this->getEntityManager());
            $respuesta = $SaveDataRepository->saveData($post,$tabla->getClase());
            echo Json::encode($respuesta);
            exit;
    	}else{
            $respuesta = array (
                "respuesta" => false,
                "mensaje" => "ERROR AL GUARDAR EL REGISTRO.",
            );
            echo Json::encode($respuesta);
            exit;
    	}
    	
    }
    
    public function editarAction()
    {
    	$request = $this->getRequest();
    	$viewmodel = new ViewModel();
    	$viewmodel->setTerminal($request->isXmlHttpRequest());
        
        $paramsContainer = new Container('params');
        if ( $paramsContainer->offsetExists('id') )
            $id = $paramsContainer->offsetGet('id');
        $em = $this->getEntityManager();
    	$tabla = $em->getRepository('Application\Entity\ClaTablasParametricas')->find($id);
    	$errorEnFormulario = false;
    	$options = array("em"=>$this->getEntityManager(),
    	"use_filter" => true);
    	$form = new PlantillaForm($tabla->getFormName(), $options);
        $ArrayDataRepository = new ClaTablasParametricasRepository($this->getEntityManager());
        $dato = $ArrayDataRepository->getForm($this->params()->fromRoute('id',$this->params()->fromQuery('id','0')),$tabla->getClase());
    	$form->setData($dato);   	
        $viewmodel->setVariables(array(
                'tabla'=>$tabla,
                "form"=>$form,
                "error_en_formulario"=>$errorEnFormulario,
        ));
        return $viewmodel;
   	
    }
    
    
    
}
