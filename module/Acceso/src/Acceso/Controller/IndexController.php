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
use MisLibrerias\DbFactory;

/**
 * This class is the responsible to answer the requests to the /wall endpoint
 *
 * @package Wall/Controller
 */
class IndexController extends AbstractRestfulController
{
    /**
     * Holds the table object
     *
     * @var UsersTable
     */
    protected $usersTable;
    
    /**
     * Holds the table object
     *
     * @var UserImagesTable
     */
    protected $userImagesTable;
    
    /**
     * Method not available for this endpoint
     *
     * @return void
     */
    public function getOlddd($username)
    {
        $usersTable = $this->getUsersTable();
        $userImagesTable = $this->getUserImagesTable();
        
        $userData = $usersTable->getByUsername($username);
        
        if ($userData !== false) {
            $userData['avatar'] = $userImagesTable->getById($userData['avatar_id']);
            return new JsonModel($userData);
        } else {
            throw new \Exception('User not found', 404);
        }
    }
    
    public function get($username)
    {
    	
    	$entityManager = $this->getEntityManager('seguridad');
    	//$user = $entityManager->getRepository('AuthDoctrine\Entity\UsuarioPerfil')->findOneBy(array('idUsuario' => 1)); //
    	
    	$query = $entityManager->createQuery('SELECT up FROM \Application\Entity\Usuario up
											WHERE up.usrName = :usr_name');
    	$query->setParameter('usr_name', $username);
    	$userData = $query->getArrayResult();
    	
    	$usrIdPersona = $userData[0]['usrIdPersona'];
    	$usrId = $userData[0]['usrId'];
    	$usrName = $userData[0]['usrName'];
    	
    	
    	$entityManager = $this->getEntityManager("movilidad");
    	$sql = "SELECT * FROM v_planilla_externos WHERE id_persona = ".$usrIdPersona."";
    	$util = new \Application\Entity\Repositories\UtilsRepository($entityManager);
    	$persona = $util->execNativeSql($sql);
    	
    	$datos['userData'] = $userData;
    	$datos['personaData'] = $persona;
    	
    	
    	
    	$nombrePersona = "";
    	$cargo = "";
    	$puesto = "";
    	$unidadOrganizacional = "";
    	$idUnidadOrganizacional = "";
    	$nombreEntidad = "";
    	$siglaEntidad = "";
    	$siglaUnidad = "";
    	$idEntidad = "";
    		
    	if(isset($persona) && count($persona)>0){
    		/*	$persona = $persona[0];
    		 $nombrePersona = $persona['nombres']." ".$persona['paterno']." ".$persona['materno'];
    		$cargo = $persona['cargo'];
    		$puesto = $persona['puesto'];
    		$unidadOrganizacional = $persona['unidad'];
    		$nombreEntidad = $persona['entidad'];
    		$siglaEntidad = $persona['entidad_sigla'];
    		*/
    		$persona = $persona[0];
    		$nombrePersona = $persona['nombres']." ".$persona['paterno']." ".$persona['materno'];
    		$cargo = $persona['cargo'];
    		$puesto = $persona['puesto'];
    		$unidadOrganizacional = $persona['unidad'];
    		$idUnidadOrganizacional = $persona['id_unidad'];
    		//$siglaEntidad = $persona['sigla_unidad'];
    		$nombreEntidad = $persona['entidad'];
    		$siglaEntidad = $persona['sigla_entidad'];
    		$siglaUnidad = $persona['sigla_unidad'];
    		$idEntidad = $persona['id_entidad'];
    	
    	}
    		
    	$entityManager = $this->getEntityManager('seguridad');
    	$sql = "SELECT p.id, p.nombre, p.sigla
							FROM usuario_perfil up left join perfil p on up.id_perfil = p.id
							    left join usuario u on up.id_usuario = u.usr_id
							where up.id_usuario = ".$usrId."";
    	$util = new \Application\Entity\Repositories\UtilsRepository($entityManager);
    	$perfiles = $util->execNativeSql($sql);
    		
    	$listaPerfiles = array();
    	if($perfiles){
    		//$listaPerfiles = array();
    	
    		foreach ($perfiles as $perfil){
    			$listaPerfiles[$perfil['nombre']] = $perfil['sigla'];
    		}
    	}
    	
    	$entityManager = $this->getEntityManager('seguridad');
    	//$user = $entityManager->getRepository('AuthDoctrine\Entity\UsuarioPerfil')->findOneBy(array('idUsuario' => 1)); //
    	
    	$query = $entityManager->createQuery('SELECT up FROM \Application\Entity\UsuarioPerfil up
											WHERE up.idUsuario = :idUsuario');
    	$query->setParameter('idUsuario', $usrId);
    	$usuarioPerfilResult = $query->getArrayResult();
    	
    	
    	// Debug::dump($usuarioPerfilResult);
    	
    	$query = $entityManager->createQuery('SELECT p FROM \Application\Entity\Perfil p
											WHERE p.id = :id');
    	$query->setParameter('id', $usuarioPerfilResult[0]["idPerfil"]);
    	$perfilResult = $query->getArrayResult();
    	
    	$query = $entityManager->createQuery('SELECT a FROM \Application\Entity\Aplicacion a
											WHERE a.id = :id');
    	$query->setParameter('id', $perfilResult[0]["idAplicacion"]);
    	$aplicacionResult = $query->getArrayResult();
    	
    	$urlAplicacion = $aplicacionResult[0]["url"];
    	
    	//                     $isIdUnidadOrganizacional = false;
    	//                     if($usuarioPerfilResult[0]["idUnidad"] != $idUnidadOrganizacional){
    	//                     	$isIdUnidadOrganizacional = true;
    	//                     	return new ViewModel(array(
    	//                     			'error' => 'Verifique no coincide Unidad Organizacional',
    	//                     			'form'	=> $form,
    	//                     			'messages' => 'Usuario no asignado a Unidad Organizacional, consulte con el Adminsitrador. Gracias.',
    	//                     	));
    	 
    	//                     }
    	
    	$lista_permisos =array('permissions' => array(
    			'ope_op' => array(
    					'home',
    					'application',
    					//'application/default',
    					'application/solicitudinsumo',
    					'application/formulacion',
    					'application/objetivogestion',
    					'application/objetivoespecifico',
    					'application/operacion',
    					'application/reportes',
    					'application/insumo',
    					'application/autorizarsolicitud',
    			),
    			'adm' => array(
    					//'application/formulacion',
    					'application/objetivoespecifico',
    					'application/objetivogestion',
    					'application/reportes',
    	
    			)
    	));
    	
    	$datosSesionArray = array(
    	
    	
    			'id_usuario'=>$usrId,
    			'lista_perfiles'=>$listaPerfiles,
    			'lista_permisos'=>$lista_permisos,
    			'id_rol'=>$perfilResult[0]["id"],
    			'nombre_rol'=>$perfilResult[0]["nombre"],
    			'sigla_rol'=>$perfilResult[0]["sigla"],
    			'sigla_aplicacion'=>$aplicacionResult[0]["sigla"],
    			'nombre_aplicacion'=>$aplicacionResult[0]["nombre"],
    			'url'=>$aplicacionResult[0]["url"],
    			'id_usuario'=>$usrId,
    			'login_usuario'=>$usrName,
    			'nombre_usuario'=>$nombrePersona,
    			'cargo'=> $cargo,
    			'puesto'=> $puesto,
    			'nombre_entidad'=> $nombreEntidad,
    			'sigla_entidad'=> $siglaEntidad,
    			'entidad'=>$siglaEntidad, // "MEFP", //"MEFP",
    			'id_entidad'=>$idEntidad,
    			'unidad_organizacional'=>$usuarioPerfilResult[0]["idUnidad"],
    			'unidad_organizacional_sigla'=>$siglaUnidad,
    			'unidad_organizacional_nombre'=> $unidadOrganizacional,
    	
    	);
    	 
    	
    	
    	if ($datosSesionArray !== false) {
    		//throw new \Exception('User not found', 404);
    		return new JsonModel($datosSesionArray);
    	} else {
    		throw new \Exception('User not found', 404);
    	}
    	
//         $usersTable = $this->getUsersTable();
//         $userImagesTable = $this->getUserImagesTable();
        
//         $userData = $usersTable->getByUsername($username);

//         if ($userData !== false) {
//         	$userData['avatar'] = $userImagesTable->getById($userData['avatar_id']);
//         	return new JsonModel($userData);
//         } else {
//         	throw new \Exception('User not found', 404);
//         }
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
    public function create($unfilteredData)
    {
        $usersTable = $this->getUsersTable();
        
        $filters = $usersTable->getInputFilter();
        $filters->setData($unfilteredData);
        
        if ($filters->isValid()) {
            $data = $filters->getValues();
            
            $avatarContent = array_key_exists('avatar', $unfilteredData) ? $unfilteredData['avatar'] : NULL;
            
            $bcrypt = new Bcrypt();
            $data['password'] = $bcrypt->create($data['password']);
            
            if ($usersTable->create($data)) {
                if (!empty($avatarContent)) {
                    $userImagesTable = $this->getUserImagesTable();
                    $user = $usersTable->getByUsername($data['username']);
                    
                    $filename = sprintf('public/images/%s.png', sha1(uniqid(time(), TRUE)));
                    $content = base64_decode($avatarContent);
                    $image = imagecreatefromstring($content);
                    
                    if (imagepng($image, $filename) === TRUE) {
                        $userImagesTable->create($user['id'], basename($filename));
                    }
                    imagedestroy($image);
                    
                    $image = $userImagesTable->getByFilename(basename($filename));
                    $usersTable->updateAvatar($image['id'], $user['id']);
                }
                
                $result = new JsonModel(array(
                    'result' => true
                ));
            } else {
                $result = new JsonModel(array(
                    'result' => false
                )); 
            }
        } else {
            $result = new JsonModel(array(
                'result' => false,
                'errors' => $filters->getMessages()
            ));
        }
        
        return $result;
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
    
    /**
     * This is a convenience method to load the userImagesTable db object and keeps track
     * of the instance to avoid multiple of them
     *
     * @return UserImagesTable
     */
    protected function getUserImagesTable()
    {
        if (!$this->userImagesTable) {
            $sm = $this->getServiceLocator();
            $this->userImagesTable = $sm->get('Users\Model\UserImagesTable');
        }
        return $this->userImagesTable;
    }
    
    /**
     * @var Doctrine\ORM\EntityManager
     */
    protected $em;
    
    protected function getEntityManager($database = 'seguridad_desa')
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