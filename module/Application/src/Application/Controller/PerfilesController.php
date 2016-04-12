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
use MisLibrerias\DatosSesion;

class PerfilesController extends BaseController
{
    public function indexAction()
    {
       // $op = new \Application\Entity\Repositories\PeiRepository($this->getEntityManager());
        //$op = new PeiRepository($this->getEntityManager());
        //$res = $op->findAllPei();
        
    	$entityManager = $this->getEntityManager();
    	
    	$idUsuario = DatosSesion::getIdUsuario();

    	$query = $entityManager->createQuery('SELECT p FROM \Application\Entity\Perfil p');
    	$perfilesResult = $query->getArrayResult();
    	
    	
        return new ViewModel(array("listaPerfiles"=>$perfilesResult));
    }


}
