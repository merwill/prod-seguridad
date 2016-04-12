<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Perfiles\Controller;

use Zend\Debug\Debug;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
use Zend\Crypt\Password\Bcrypt;
use MisLibrerias\DbFactory;
use Zend\XmlRpc\Value\Integer;

/**
 * This class is the responsible to answer the requests to the /usuario endpoint
 *
 * @package Usuario/Controller
 */
class PerfilesRestController extends AbstractRestfulController
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
    
    public function get($idAplicacion)
    {
       // try{
            $entityManager = $this->getEntityManager('prod_seguridad_diseno');
            $sql = "SELECT p.* FROM perfil p WHERE p.id_aplicacion = $idAplicacion";
            $util = new \Application\Entity\Repositories\UtilsRepository($entityManager);
            $perfiles = $util->execNativeSql($sql);
            if ($perfiles) {
                return new JsonModel($perfiles);
            } else {
                //return new JsonModel(array('error'));
                throw new \Exception('ERROR DE CONSULTA [1er nivel]', 404);

               /* $result = new JsonModel(array(
                    'result' => false,
                    'errors' => 'ERRRRR'
                ));
                return $result;*/
            }
       /* }catch(\Exception $e){

            throw new \Exception("ERROR DE CONSULTA [2er nivel]",404);

            /*$result = new JsonModel(array(
                'result' => false,
                'errors' => $e->getMessage()
            ));

            return $result;
        }*/
    }

    /**
     * Method not available for this endpoint
     *
     * @return void
     */
    public function getListadito()
    {
        $idPerfil = $this->params()->fromRoute('idPerfil');
        $entityManager = $this->getEntityManager('prod_seguridad_diseno');
        $sql = "SELECT p.* FROM perfil p WHERE p.id = $idPerfil";
        $util = new \Application\Entity\Repositories\UtilsRepository($entityManager);
        $perfiles = $util->execNativeSql($sql);
        if ($perfiles) {
            return new JsonModel($perfiles);
        } else {
            throw new \Exception('ERROR: No hay datos.', 404);
        }
    }
    
    public function getList()
    {
        $request = $this->params()->fromRoute();
        if(isset($request['idPersona'])){

            $idPersona = $request['idPersona'];
            $entityManager = $this->getEntityManager('prod_movilidad');
            $util = new \Application\Entity\Repositories\UtilsRepository($entityManager);
            $sql = "select * from v_planilla_general where id_persona = ".$idPersona;
            $usuarioPersona = $util->execNativeSql($sql);
            if($usuarioPersona){
                return new JsonModel($usuarioPersona);
            } else {
                throw new \Exception('ERROR: No hay dato de la persona.', 404);
            }

        }else{


            if(isset($request['idPerfil'])){
//return new JsonModel($idPerfil['idPerfil']);
                //$idPersona = $this->params()->fromRoute('idPersona');

                $idPerfil =(int)$request['idPerfil'];
                $entityManager = $this->getEntityManager('prod_seguridad_diseno');
            $sql = "select u.usr_id, u.usr_name, u.usr_email, u.usr_registration_date, u.usr_id_persona
                    from perfil p left join usuario_perfil up on p.id = up.id_perfil
                    left join usuario u on u.usr_id = up.id_usuario
                    where p.id = $idPerfil
                    order by u.usr_name";
            $util = new \Application\Entity\Repositories\UtilsRepository($entityManager);
            $listaUsuariosSeguridad = $util->execNativeSql($sql);Debug::dump($listaUsuariosSeguridad);exit();
            if ($listaUsuariosSeguridad) {

                $lista = array();

                $entityManager = $this->getEntityManager('prod_movilidad');
                $util = new \Application\Entity\Repositories\UtilsRepository($entityManager);
                foreach($listaUsuariosSeguridad as $usuario){
                    //$id_persona = $usuario['usr_id_persona'] != "" ? $usuario['usr_id_persona'] : 0;

                    if($usuario['usr_id_persona'] != "" || $usuario['usr_id_persona'] != null){
                        $sql = "select * from v_planilla_general where id_persona = ".$usuario['usr_id_persona'];
                        $usuarioPersona = $util->execNativeSql($sql);
                        $aux['usuario-post'] = $usuario;
                        $aux['persona-post'] = $usuarioPersona;
                    }else{
                        $aux['usuario-post'] = $usuario;
                        $aux['persona-post'] = array();
                    }
                    $lista[] = $aux;
                }
                return new JsonModel($listaUsuariosSeguridad);
            } else {
                throw new \Exception('ERROR: No hay datos.', 404);
            }


        }elseif(isset($request['idAplicacion'])){


                $idAplicacion =(int)$request['idAplicacion'];
                $entityManager = $this->getEntityManager('prod_seguridad_diseno');
                $sql = "SELECT p.* FROM perfil p WHERE p.id_aplicacion = $idAplicacion";
                $util = new \Application\Entity\Repositories\UtilsRepository($entityManager);
                $perfiles = $util->execNativeSql($sql);
                if ($perfiles) {
                    return new JsonModel($perfiles);
                } else {
                    throw new \Exception('ERROR DE CONSULTA [1er nivel]', 404);
                }

        }
        }
    }

    /**
     * This method inspects the request and routes the data
     * to the correct method
     *
     * @return void
     */
    public function create($data)
    {
        $idPerfil = $data['idPerfil'];
        //$idPersona = $this->params()->fromRoute('idPersona');
        $entityManager = $this->getEntityManager('prod_seguridad_diseno');
        $sql = "select u.usr_id, u.usr_name, u.usr_email, u.usr_registration_date, u.usr_id_persona , p.nombre
                from perfil p left join usuario_perfil up on p.id = up.id_perfil
                left join usuario u on u.usr_id = up.id_usuario
                where p.id = $idPerfil
                order by u.usr_name";
        $util = new \Application\Entity\Repositories\UtilsRepository($entityManager);
        $listaUsuariosSeguridad = $util->execNativeSql($sql);
        if ($listaUsuariosSeguridad) {

            $sql = "select p.*
                from perfil p
                where p.id = $idPerfil";
            $util = new \Application\Entity\Repositories\UtilsRepository($entityManager);
            $perfil = $util->execNativeSql($sql);

            $lista = array();
            $lista[] = array("perfil"=>$perfil[0]);

            $entityManager = $this->getEntityManager('prod_movilidad');
            $util = new \Application\Entity\Repositories\UtilsRepository($entityManager);
            foreach($listaUsuariosSeguridad as $usuario){
                if($usuario['usr_id_persona'] != "" || $usuario['usr_id_persona'] != null){
                    $sql = "select * from v_planilla_general where id_persona = ".$usuario['usr_id_persona'];
                    $usuarioPersona = $util->execNativeSql($sql);
                    $aux['usuario-post'] = $usuario;

                    if(count($usuarioPersona)>0){
                        $aux['persona-post'] = $usuarioPersona[0];
                    }else{
                        $aux['persona-post'] = array();
                    }


                }else{
                    $aux['usuario-post'] = array();
                    $aux['persona-post'] = array();
                }


                //$lista[] = array("perfil_nombre"=>$idPerfil);
                $lista[] = $aux;
            }

            return new JsonModel($lista);
        } else {
            throw new \Exception('ERROR: No hay datos.', 404);
        }
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
    
    protected $em;
    
    protected function getEntityManager($database = 'prod_seguridad_diseno')
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