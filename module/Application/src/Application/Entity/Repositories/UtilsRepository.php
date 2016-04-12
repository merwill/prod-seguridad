<?php
namespace Application\Entity\Repositories;

/**
 *  UtilsRepository
 *  Ejecucion de consultas nativas SQL y helper de apoyo Generador de Formularios
 * @author walvarez
 */
class UtilsRepository extends BaseEntityRepository {
	
	protected static $instance;
	//protected static $instance;

//    function __construct(){
//        $this->em =  \Zend_Registry::get ( 'doctrine' )->getEntityManager ();
//    }

 	/**
 	 * Ejecucion de consultas nativas
 	 * @param string $sqlQuery
 	 * @return array
 	 */
	public function execNativeSql($sqlQuery) {
		try {

            $em = $this->em;
            //$em = $this->getEntityManager();

			$stmt = $em->getConnection()->prepare($sqlQuery);
			$stmt->execute();
			$result = $stmt->fetchAll();
            if($result)
			    return $result;
			else
                return array();
		} catch (\Exception $e) {
			//Logger::showErrorDoctrine("Error al ejecutar: execNativeSql",$e);
            throw $e;
		}
	}
	
	/**
	 * Obtiene datos Parametros generales del formulario
	 * @param string $formName
	 * @return array:
	 */
	public function getFormularioParametros($formName) {
		try {
			//self::getInstance();

            $sqlQuery = "SELECT *
						 FROM formulario_parametros 
						 WHERE form_name = '".$formName."'
						 AND estado = '1'";
	
			$formParametros = $this->execNativeSql($sqlQuery);
			
			return $formParametros[0];
				
		} catch (\Exception $e) {
			//Logger::showErrorDoctrine("Error al ejecutar: getFormularioParametros",$e);
            throw $e;
		}
	}
	
	/**
	 * Obtiene los objetos del formulario
	 * @param integer $formParamId
	 * @return array:
	 */
	public function getFormularioObjetos($formParamId) {
		try {

			$sqlQuery = "SELECT * 
						 FROM formulario_objetos 
						 WHERE form_param_id = $formParamId 
						 AND estado = '1'
						 ORDER BY orden";
	
			$formObjetos = $this->execNativeSql($sqlQuery);

            if(isset($formObjetos))
			    return $formObjetos;
	        else
                return array();


		} catch (\Exception $e) {
			//Logger::showErrorDoctrine("Error al ejecutar: getFormularioObjetos",$e);
            throw $e;
		}
	}
	
}
