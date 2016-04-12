<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Acceso\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
use Zend\Crypt\Password\Bcrypt;
use Zend\Authentication\Result;
use Zend\Session\Container;
use Zend\Serializer\Serializer;
use MisLibrerias\DbFactory;

/**
 * This class is the responsible to answer the requests to the /wall endpoint
 *
 * @package Wall/Controller
 */
class LoginController extends AbstractRestfulController
{
    /**
     * Holds the table object
     *
     * @var UsersTable
     */
    protected $usersTable;
    
    /**
     * Method not available for this endpoint
     *
     * @return void
     */
    public function get($username)
    {
        $this->methodNotAllowed();
    }
    
    /**
     * Method not available for this endpoint
     *
     * @return void
     */
    public function getList()
    {
        $this->methodNotAllowed();
    }
    
    /**
     * This method inspects the request and routes the data
     * to the correct method
     *
     * @return void
     */
    public function create22($data)
    {
        $usersTable = $this->getUsersTable();
        $user = $usersTable->getByUsername($data['username']);
        
        $bcrypt = new Bcrypt();
        if (!empty($user) && $bcrypt->verify($data['password'], $user->password)) {
            $result = new JsonModel(array(
                'result' => true,
                'errors' => null
            ));
        } else {
            $result = new JsonModel(array(
                'result' => false,
                'errors' => 'Invalid Username or password'
            ));
        }
        
        /*$result = new JsonModel(array(
        		'result' => true,
        		'errors' => null
        ));
        */
        return $result;
    }
    
    public function create($data)
    {
    	$user = $this->getlogin($data);

    	if($user == "OK"){
    		$result = new JsonModel(array(
    				'result' => true,
    				'mensaje' => array('Usuario validado..')
    		));
    	}else{
    		$result = new JsonModel(array(
    				'result' => false,
    				'mensaje' => array($user)

    		));
    	}
    	return $result;
    	
    	
//         $usersTable = $this->getUsersTable();
//         $user = $usersTable->getByUsername($data['username']);
        
//         $bcrypt = new Bcrypt();
//         if (!empty($user) && $bcrypt->verify($data['password'], $user->password)) {
//             $result = new JsonModel(array(
//                 'result' => true,
//                 'errors' => null
//             ));
//         } else {
//             $result = new JsonModel(array(
//                 'result' => false,
//                 'errors' => 'Invalid Username or password'
//             ));
//         }
        
        /*$result = new JsonModel(array(
        		'result' => true,
        		'errors' => null
        ));
        */
        //return $result;
    }
    
    /**
     * Method not available for this endpoint
     *
     * @return void
     */
    public function update($id, $data)
    {
        $this->methodNotAllowed();
    }
    
    /**
     * Method not available for this endpoint
     *
     * @return void
     */
    public function delete($id)
    {
        $this->methodNotAllowed();
    }
    
    protected function methodNotAllowed()
    {
        $this->response->setStatusCode(\Zend\Http\PhpEnvironment\Response::STATUS_CODE_405);
    }
    
    /**
     * This is a convenience method to load the usersTable db object and keeps track
     * of the instance to avoid multiple of them
     *
     * @return UsersTable
     */
    protected function getUsersTable()
    {
        if (!$this->usersTable) {
            $sm = $this->getServiceLocator();
            $this->usersTable = $sm->get('Users\Model\UsersTable');
        }
        return $this->usersTable;
    }
    
    protected function getlogin($data)
    {
    
    
    			$authService = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
    			// Do the same you did for the ordinar Zend AuthService
    			$adapter = $authService->getAdapter();
    			$adapter->setIdentityValue($data['username']); //$data['usr_name']
    			$adapter->setCredentialValue($data['password']); // $data['usr_password']
    			$authResult = $authService->authenticate();
    
    			switch ($authResult->getCode()) {
    
    				case Result::FAILURE_IDENTITY_NOT_FOUND:
    					$messages = "Usuario no válido.";
    					break;
    
    				case Result::FAILURE_CREDENTIAL_INVALID:
    					$messages = "Credenciales no válidas.";
    					break;
    
    				case Result::SUCCESS:
    					$messages = "OK";
    					break;
    
    				default:
    					$messages = "error";
    					break;
    			}
    
    
    
    			if ($authResult->isValid()) {
    				
    				return true;
    				
    			
    					
    			}else {
    				return $messages;
    			}
    			
    		
    	

    }
    
    /**
     * @var Doctrine\ORM\EntityManager
     */
    protected $em;
    
    public function getEntityManager($database = 'prod_seguridad_diseno')
    {
    	// 		if (null === $this->em) {
    	// 			$this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
    	// 		}
    
    	$applicationConfig = $this->getServiceLocator()->get('config');
    	$em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
    	$emDefaultConfig = $em->getConfiguration();
    
    	$dbFactory = new DbFactory($applicationConfig);
    	$anotherConnection = $dbFactory->getConnectionToDatabase($database);
    	$anotherEntityManager = $dbFactory->getEntityManager($anotherConnection, $emDefaultConfig);
    
    	$this->em =  $anotherEntityManager;
    
    	return $this->em;
    }
    
}