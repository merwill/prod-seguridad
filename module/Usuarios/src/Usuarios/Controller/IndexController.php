<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Usuarios for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Usuarios\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Application\Controller\BaseController;
use Zend\View\Model\ViewModel;
use Zend\Debug\Debug;

class IndexController extends BaseController
{
    public function indexAction()
    {
    	
    	$entityManager = $this->getEntityManager();
    	$entityManagerSirh = $this->getEntityManager("sirh");
    	
    	$dql = "SELECT u 
    			FROM \\Application\\Entity\\Usuario u";
    	
    	$query = $entityManager->createQuery($dql);
    	$usuarios = $query->getArrayResult();
    	
    	//$usuarios = $query->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
    	
    	//$usuarios = array();
    	//Debug::dump($usuarios);
    	
    	$utilRepositorio = new \Application\Entity\Repositories\UtilsRepository($entityManager);
		
    	$listaUsuariosPersona = array();
    	foreach ($usuarios as $usuario){
    		
    		$usrIdPersona = 0;
    		if($usuario['usrIdPersona'] != null){
    			$usrIdPersona = $usuario['usrIdPersona'];
    		}
    		
    		$sql = "SELECT * 
    				FROM v_planilla_general
    				WHERE id_persona = ".$usrIdPersona."";
     		$persona = $utilRepositorio->execNativeSql($sql);
    		
    		$aux['usuario'] = $usuario;
    		$aux['persona'] = $persona;
    		$listaUsuariosPersona[]= $aux;
    	}
    	
    	//Debug::dump($listaUsuariosPersona);
    	
		$renderView = new ViewModel(array (
				'listaUsuariosPersona' => $listaUsuariosPersona,
				'entityManagerSirh' => $entityManagerSirh,
		) );
		return $renderView;
    }

}
