<?php
namespace Application\Controller;

use Doctrine\ORM\EntityManager;
use MisLibrerias\DbFactory;
use Zend\Mvc\Controller\AbstractActionController;

class BaseController extends AbstractActionController
{

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    public function onDispatch(\Zend\Mvc\MvcEvent $e){
   
        $request = $e->getRouteMatch();
        $controller = $request->getParam("controller");
        $action = $request->getParam("action");

       $auth = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
      
        if (!$auth->hasIdentity() || \MisLibrerias\DatosSesion::getSiglaAplicacion() != "SAA") {
        	//return $this->redirect()->toRoute('auth-doctrine/default', array('controller' => 'index', 'action' => 'login'));
        	return $this->redirect()->toRoute('auth-doctrine/login');
        }

        return parent::onDispatch( $e );
    }

    public function setEntityManager(EntityManager $em) {
        $this->em = $em;
    }

    public function getEntityManager($database = 'prod_seguridad_diseno')
    {
       // if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('\Doctrine\ORM\EntityManager');
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

            /*$applicationConfig = $this->getServiceLocator()->get('config');
            $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
            $emDefaultConfig = $em->getConfiguration();

            $dbFactory = new DbFactory($applicationConfig);
            $anotherConnection = $dbFactory->getConnectionToDatabase($database );
            $anotherEntityManager = $dbFactory->getEntityManager($anotherConnection, $emDefaultConfig);

            $this->em =  $anotherEntityManager;
*/
       // $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
            

        //}
        return $this->em;

    }
    
//     public function getEntityManager()
//     {
//         if (null === $this->em) {
//             //$this->em = $this->getServiceLocator()->get('\Doctrine\ORM\EntityManager');
//             //$this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

//             $applicationConfig = $this->getServiceLocator()->get('config');
//             $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
//             $emDefaultConfig = $em->getConfiguration();

//             $dbFactory = new DbFactory($applicationConfig);
//             $anotherConnection = $dbFactory->getConnectionToDatabase('seguridad');
//             $anotherEntityManager = $dbFactory->getEntityManager($anotherConnection, $emDefaultConfig);

//             $this->em =  $anotherEntityManager;


//         }
//         return $this->em;

//     }

}