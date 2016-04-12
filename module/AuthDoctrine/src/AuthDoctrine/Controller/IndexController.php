<?php
namespace AuthDoctrine\Controller;

// Authentication with Remember Me

use Zend\Filter\Encrypt;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Serializer\Serializer;
use Zend\Session\Container;
use Zend\View\Model\ViewModel;

// use Auth\Model\Auth;          we don't need the model here we will use Doctrine em 
use AuthDoctrine\Entity\Usuario; // only for the filters
use AuthDoctrine\Form\LoginForm;       // <-- Add this import
use AuthDoctrine\Form\LoginFilter;
use Zend\Authentication\Result;
use Zend\Debug\Debug;
use MisLibrerias\DbFactory;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
    	$layout = $this->layout('layout/layout-login');
    
     
	    $auth = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
		//Debug::dump($auth->hasIdentity(),"index");

	    if (!$auth->hasIdentity()) {
	    	//return $this->redirect()->toRoute('auth-doctrine/login');
	    	return $this->redirect()->toRoute('home');
	    }
    
		$users = null; //$em->getRepository('Application\Entity\Usuario')->findAll();
		
        $message = $this->params()->fromQuery('message', 'foo');
        return new ViewModel(array(
			'message' => $message,
			'users'	=> $users,
		));
    }
	
    public function loginAction()
    {


        $layout = $this->layout('layout/layout-login');
		$request = $this->params()->fromPost('aplicaciones','');
		//Debug::dump($request, "request");

        $auth = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');

		//Debug::dump($auth->hasIdentity(), "login");

		$form = new LoginForm();
		$messages = null;


        if ($request == "") {
        	/*
        	$auth->clearIdentity();
        	$sessionManager = new \Zend\Session\SessionManager();
        	$sessionManager->forgetMe();
        	//$sessionManager->expireSessionCookie();
        	$session = new Container('datos_sesion');
        	$session->datos_sesion = null;
*/


			$this->clearSession();

			//return $this->redirect()->toRoute('auth-doctrine/login');



        }elseif ($auth->hasIdentity()){
			$identity = $auth->getIdentity();

			$config = $this->getServiceLocator()->get('config');
			$connectionSeguridad = $config['doctrine']['connection']['orm_default']['params']['dbname'];

			$entityManager = $this->getEntityManager($connectionSeguridad);
			$sql = "select distinct p.id_aplicacion, a.*
							from perfil p left join aplicacion a on a.id = p.id_aplicacion
							WHERE p.id in
								(select up.id_perfil
								from usuario_perfil up
								WHERE up.id_usuario = ".$identity->getUsrId()."
								and up.estado = true)
							ORDER BY 2";
			$util = new \Application\Entity\Repositories\UtilsRepository($entityManager);
			$aplicacionesRegistradas = $util->execNativeSql($sql);
			//Debug::dump($aplicacionesRegistradas, "APLICACIONES");

			$listaAplicaciones = array(''=>'Seleccione');
			foreach($aplicacionesRegistradas as $app){
				$listaAplicaciones[$app['id']] = $app['nombre'];
			}

			$form = new LoginForm();
			$form->get('aplicaciones')->setAttribute('options' ,$listaAplicaciones);
			$form->get('aplicaciones')->setAttribute('required', 'required');
			//Debug::dump($form->get('aplicaciones'));exit();

			//$this->clearSession();
		}



		$aplicacionesRegistradas = array();



		$request = $this->getRequest();
        if ($request->isPost()) {
			$form->setInputFilter(new LoginFilter($this->getServiceLocator()));
            $form->setData($request->getPost());
            if ($form->isValid()) {
				$data = $form->getData();

				$identity = null;
				if (!$auth->hasIdentity()) {
					// If you used another name for the authentication service, change it here
					// it simply returns the Doctrine Auth. This is all it does. lets first create the connection to the DB and the Entity
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
							$messages = "Seleccione una aplicación.";
							break;

						default:
							$messages = "";
							break;
					}

					if ($authResult->isValid()) {
						$identity = $authResult->getIdentity();
					}
				}else{
					$identity = $auth->getIdentity();
				}
				if ($identity) {
					//$identity = $authResult->getIdentity();

					$usrIdPersona = 0;
					if ($identity->getUsrIdPersona()) {
						$usrIdPersona = $identity->getUsrIdPersona();
					}

					$config = $this->getServiceLocator()->get('config');
					$connectionSeguridad = $config['doctrine']['connection']['orm_default']['params']['dbname'];

					//******************************************************************

					if ( !isset($data['aplicaciones']) || $data['aplicaciones'] == ""){
						$entityManager = $this->getEntityManager($connectionSeguridad);
						$sql = "select distinct p.id_aplicacion, a.*
								from perfil p left join aplicacion a on a.id = p.id_aplicacion
								WHERE p.id in
									(select up.id_perfil
									from usuario_perfil up
									WHERE up.id_usuario = " . $identity->getUsrId() . "
									and up.estado = true)
								ORDER BY 2";
						$util = new \Application\Entity\Repositories\UtilsRepository($entityManager);
						$aplicacionesRegistradas = $util->execNativeSql($sql);
						//Debug::dump($aplicacionesRegistradas, "APLICACIONES");

						$listaAplicaciones = array('' => 'Seleccione Aplicacion');
						foreach ($aplicacionesRegistradas as $app) {
							$listaAplicaciones[$app['id']] = $app['nombre'];
						}

						//$form = new LoginForm();
						$form->get('aplicaciones')->setAttribute('options', $listaAplicaciones);
						$form->get('aplicaciones')->setAttribute('required', 'required');

						//$form->setData($request->getPost());
						//$data = $form->getData();
							//Debug::dump($data['aplicaciones']);
						echo "Session APP: ".session_id();
						if (count($aplicacionesRegistradas) > 1) {
							return new ViewModel(array(
								'error' => 'Your authentication credentials are not valid',
								'form' => $form,
								'messages' => $messages,
								'aplicacionesRegistradas' => $aplicacionesRegistradas,
							));
						}elseif (count($aplicacionesRegistradas) == 1){
							$idAplicacionRegistradaSeleccionada = $aplicacionesRegistradas[0]['id_aplicacion'];
						}
					}else{

						$idAplicacionRegistradaSeleccionada = $data['aplicaciones'];
					}
					//******************************************************************

					//$idAplicacionRegistradaSeleccionada = $data['aplicaciones'];

					$entityManager = $this->getEntityManager('prod_movilidad');
					$sql = "SELECT * FROM v_planilla_general WHERE id_persona = ".$usrIdPersona."";
					$util = new \Application\Entity\Repositories\UtilsRepository($entityManager);
					$persona = $util->execNativeSql($sql);
					//Debug::dump($persona, "DATOS PERSONA");
					
					$nombrePersonaMof = "";
					$cargoMof = "";
					$puestoMof = "";
					$idPersonaMof = "";
					$nombreUnidadMof = "";
					$nombreEntidadMof = "";
					$siglaEntidadMof = "";
					$siglaUnidadMof = "";
					$idEntidadMof = "";
					$idUnidadMof = "";
					$ciMof = "";
					if(isset($persona)  && count($persona)>0){
						$persona = $persona[0];
						$nombrePersonaMof = $persona['nombres']." ".$persona['paterno']." ".$persona['materno'];
						$cargoMof = $persona['cargo'];
						$puestoMof = $persona['puesto'];
						$idPersonaMof = $persona['id_persona'];
						$nombreEntidadMof = $persona['entidad'];
						$siglaEntidadMof = $persona['sigla_entidad'];
						$idUnidadMof = $persona['id_unidad'];
						$siglaUnidadMof = $persona['sigla_unidad'];
						$nombreUnidadMof = $persona['unidad'];
						$idEntidadMof = $persona['id_entidad'];
						$ciMof = $persona['ci'];
					}


					$entityManager = $this->getEntityManager($connectionSeguridad);
					$sql = "SELECT p.id, p.nombre, p.sigla, p.orden
							FROM usuario_perfil up left join perfil p on up.id_perfil = p.id 
							    left join usuario u on up.id_usuario = u.usr_id
							where up.id_usuario = ".$identity->getUsrId()."
							AND p.id_aplicacion = ".$idAplicacionRegistradaSeleccionada."
							AND up.estado = true
							ORDER BY p.orden";
					$util = new \Application\Entity\Repositories\UtilsRepository($entityManager);
					$perfiles = $util->execNativeSql($sql);
					//Debug::dump($perfiles, "PERFILES");
					$listaPerfiles = array();
					$listaIndexPerfiles = array();
					if($perfiles){
						foreach ($perfiles as $perfil){
						    $listaPerfiles[$perfil['nombre']] = $perfil['sigla'];
						    $listaIndexPerfiles[] = $perfil['id'];
						}
					}



					///(11,16,4,9)

					$listaIndexPerfiles = implode(",",$listaIndexPerfiles);
					//Debug::dump($lis);
					$entityManager = $this->getEntityManager($connectionSeguridad);
                    $query = $entityManager->createQuery('SELECT up FROM \Application\Entity\UsuarioPerfil up
											WHERE up.idUsuario = :idUsuario
											AND up.idPerfil in ('.$listaIndexPerfiles.')
											AND up.estado = true');
                    $query->setParameter('idUsuario', $identity->getUsrId());
                    $usuarioPerfilResult = $query->getArrayResult();

					//Debug::dump($usuarioPerfilResult, "PERFILES 222");
                    
//                     $query = $entityManager->createQuery('SELECT up FROM \Application\Entity\UsuarioPerfil up
// 											WHERE up.idUsuario = :idUsuario');
//                     $query->setParameter('idUsuario', $identity->getUsrId());
//                     $usuarioPerfilResult = $query->getArrayResult();

                   // Debug::dump($usuarioPerfilResult);




                    
                    $query = $entityManager->createQuery('SELECT p FROM \Application\Entity\Perfil p
											WHERE p.id = :id');
                    $query->setParameter('id', $usuarioPerfilResult[0]["idPerfil"]);
                    $perfilResult = $query->getArrayResult();
					//Debug::dump($perfilResult,'perfilResult');
                    
                    $query = $entityManager->createQuery('SELECT a FROM \Application\Entity\Aplicacion a
											WHERE a.id = :id');
                    $query->setParameter('id', $perfilResult[0]["idAplicacion"]);
                    $aplicacionResult = $query->getArrayResult();

					//Debug::dump($aplicacionResult,'APLICACIONES_revisar');

                    $urlAplicacion = $aplicacionResult[0]["url"];


					//*****************************************************
					// OBTENIENDO DESCRIPCION UNIDAD EJECUTORA
					$em = $this->getEntityManager('prod_mof');
					$id_unidad = $usuarioPerfilResult[0]["idUnidad"];
					$sql = "select id_unidad, sigla, denominacion, nivel from unidad where id_unidad = ".$id_unidad;
					$utilRepo = new \Application\Entity\Repositories\UtilsRepository($em);
					$registro = $utilRepo->execNativeSql($sql);
					//Debug::dump($registro);
					$unidad_ejecutora =  $registro[0];
					//*****************************************************

                    
                    $datosSesionArray = array(
                    	'id_usuario'=>$identity->getUsrId(),
                    	'mail_usuario'=>$identity->getUsrEmail(),
                        'lista_perfiles'=>$listaPerfiles,
                        'id_rol'=>$perfilResult[0]["id"],
                        'nombre_rol'=>$perfilResult[0]["nombre"],
                        'sigla_rol'=>$perfilResult[0]["sigla"],
                        'id_aplicacion'=>$aplicacionResult[0]["id"],
                        'sigla_aplicacion'=>$aplicacionResult[0]["sigla"],
                        'nombre_aplicacion'=>$aplicacionResult[0]["nombre"],
                        'url'=>$aplicacionResult[0]["url"],
						'id_persona'=>$idPersonaMof,
						'ci_persona'=>$ciMof,
                        'login_usuario'=>$identity->getUsrName(),
                        'nombre_usuario'=>$nombrePersonaMof,
                        'cargo'=> $cargoMof,
                        'puesto'=> $puestoMof,
                        'nombre_entidad'=> $nombreEntidadMof,
                        'sigla_entidad'=> $siglaEntidadMof,
                        'entidad'=>$nombreEntidadMof, //"MEFP",
                    	'id_entidad'=>$idEntidadMof,
                        'id_unidad_mof'=>$idUnidadMof,
                        'unidad_organizacional'=>$usuarioPerfilResult[0]["idUnidad"],
                        'unidad_organizacional_sigla'=>$siglaUnidadMof,
                        'unidad_organizacional_nombre'=> $nombreUnidadMof,
                        'fechaHoraIngreso' => date("d-m-Y H:i:s"),
                        'rememberme' => $data['rememberme']? $data['rememberme']: false,
						'unidad_ejecutora' => $unidad_ejecutora,
						'session_id' => session_id(),
						//'aplicaciones_registradas'=> $aplicacionesRegistradas,
					);

                    //$session = new Container('datos_sesion');
                    //$session->datos_sesion = $datosSesionArray;





					if($aplicacionResult[0]["sigla"] == "SAA"){

						$session = new Container('datos_sesion');
						$session->datos_sesion = $datosSesionArray;
						$authService = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
						$authService->getStorage()->write($identity);
						$time = 10; // 14 days 1209600/3600 = 336 hours => 336/24 = 14 days
						//if ($data['rememberme']) $authService->getStorage()->session->getManager()->rememberMe($time); // no way to get the session
						if ($data['rememberme']) {
							$sessionManager = new \Zend\Session\SessionManager();
							$sessionManager->rememberMe($time);
						}


						return $this->redirect()->toRoute('home');
					}else{

						//$this->clearSession();
//echo "Session FIN ".session_id(); exit();
	                    $parametros = Serializer::serialize($datosSesionArray);
	                    return $this->redirect()->toUrl($urlAplicacion.'/application/base/index?id='.$parametros);
					}

					Debug::dump($urlAplicacion.'/application/base/index?id='.$parametros);


                    //return $this->redirect()->toUrl('http://sipp-pruebas.economiayfinanzas.gob.bo/application/base/index?id='.$s);
				}
			}
		}

		//$sessionManager = new \Zend\Session\SessionManager();
		//$sessionManager->forgetMe();
		//session_start();
		//$sessionManager = new \Zend\Session\SessionManager();
		//$s = $sessionManager->getName();
		//Debug::dump($s);
		//echo "<br>Session ".session_id();
		return new ViewModel(array(
			'error' => 'Your authentication credentials are not valid',
			'form'	=> $form,
			'messages' => $messages,
		));
    }
	
	public function logoutAction()
	{
		$auth = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');

		if ($auth->hasIdentity()) {
			$identity = $auth->getIdentity();
		}
		$auth->clearIdentity();
//-		$auth->getStorage()->session->getManager()->forgetMe(); // no way to get to the sessionManager from the storage
		$sessionManager = new \Zend\Session\SessionManager();
		$sessionManager->forgetMe();

        $session = new Container('datos_sesion');
        $session->datos_sesion = null;
		
		 //return $this->redirect()->toRoute('home');
		//return $this->redirect()->toRoute('auth-doctrine/default', array('controller' => 'index', 'action' => 'login'));

		$configIni = new \Zend\Config\Reader\Ini();
		$config = $configIni->fromFile( getcwd() . "/config/config-general.ini");

		return $this->redirect()->toUrl($config['seguridad']['url_logout']);

	}

	public function clearSession()
	{
		$auth = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');

		if ($auth->hasIdentity()) {
			$identity = $auth->getIdentity();
		}
		$auth->clearIdentity();
//-		$auth->getStorage()->session->getManager()->forgetMe(); // no way to get to the sessionManager from the storage
		$sessionManager = new \Zend\Session\SessionManager();
		$sessionManager->forgetMe();

        $session = new Container('datos_sesion');
        $session->datos_sesion = null;

	}

	/**             
	 * @var Doctrine\ORM\EntityManager
	 */                
	protected $em;
	 
	public function getEntityManager($database = 'seguridad')
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