<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonModule for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Perfiles\Controller;

use Application\Controller\BaseController;
use Zend\View\Model\ViewModel;
use Application\Entity\Repositories\UtilsRepository;
use Doctrine\ORM\EntityManager;

class IndexController extends BaseController
{
    public function indexAction()
    {
    	
    	$entityManager = $this->getEntityManager("seguridad");
    	$entityManagerSirh = $this->getEntityManager("sirh");
    	
    	//var_dump($entityManager->getConnection());
    	
    	$dql = "SELECT p 
    			FROM \\Application\\Entity\\Perfil p
				WHERE p.estado = '1'
    			AND p.idAplicacion = 2";
    	
    	$query = $entityManager->createQuery($dql);
    	$listaPerfiles = $query->getArrayResult();
		
    	$listaPerfilesUsuarios = array();
    	foreach ($listaPerfiles as $perfil){
    		$dql = "SELECT u
    			FROM \\Application\\Entity\\UsuarioPerfil up,
    				 \\Application\\Entity\\Usuario u
				WHERE up.idPerfil = ".$perfil['id']."
				AND up.idUsuario = u.usrId
				AND up.Estado = true
    			";
    		
    		$query = $entityManager->createQuery($dql);
    		$listaUsuarios = $query->getArrayResult();
    		
    		
    		
    		
    		
    		$aux['perfil'] = $perfil;
    		$aux['usuarios'] = $listaUsuarios;
    		$listaPerfilesUsuarios[]= $aux;
    	}
    	
    	//$this->setEntityManager(null);
    	
    	 
//     	$sql = "SELECT * from v_planilla";
//     	$util = new \Application\Entity\Repositories\UtilsRepository($entityManagerSirh);
//     	$res = $util->execNativeSql($sql);
    	
//     	var_dump($res);
    	 
    		
		$renderView = new ViewModel( array (
				'listaPerfilesUsuarios' => $listaPerfilesUsuarios,
				'entityManagerSirh' => $entityManagerSirh,
		) );
		//$renderView->setTerminal ( true );
		return $renderView;
    }
}
