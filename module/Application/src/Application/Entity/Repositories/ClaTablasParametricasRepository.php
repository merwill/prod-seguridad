<?php
namespace Application\Entity\Repositories;

use Doctrine\ORM\EntityRepository;

class ClaTablasParametricasRepository extends BaseEntityRepository
{
    public function findOrdenarPorNombre()
    {
        try {
            $query = $this->em->createQuery('SELECT p FROM \Application\Entity\ClaTablasParametricas p ORDER BY p.nombre ASC');
            $result = $query->getResult();
            return $result;
        } catch (\Exception $e){
            throw new \Exception('Ocurrio un error al Consultar. '.$e);
            return false;
        }
    }
    /*
     * id : ID de la tabla parametrica a eliminar
     * clase_id : ID de la clase parametrica
     */
    public function remove($id,$clase_id)
    {
        try {
            $this->em->beginTransaction();
            $tabla = $this->em->getRepository('Application\Entity\ClaTablasParametricas')->find($clase_id);
            $dato = $this->em->getRepository($tabla->getClase())->find($id);
            $this->em->remove($dato);
            $this->em->flush ();
            $this->em->commit ();
            return $response = array (
                "respuesta" => true,
                "mensaje" => "SE ELIMINO CORRECTAMENTE EL REGISTRO" ,
                "id" => $clase_id
            );
        } catch (\Exception $e){
            $this->em->rollback ();
            $this->em->close ();
            return $response = array (
                "respuesta" => false,
                "mensaje" => "ERROR AL ELIMINAR EL REGISTRO." . $e,
                "id" => $clase_id 
            );
        }
    }
    
    public function changestate($id,$clase_id)
    {
        try {
            $this->em->beginTransaction();
            $tabla = $this->em->getRepository('Application\Entity\ClaTablasParametricas')->find($clase_id);
            $dato = $this->em->getRepository($tabla->getClase())->find($id);
            if ($dato->getEstado()=='0'){
                $dato->setEstado('1');
                //$dato->setFechaCierre(new \DateTime());
            }
                
            else
                $dato->setEstado('0');
            
            $this->em->persist($dato);
            $this->em->flush ();
            $this->em->commit ();
            
            return $response = array (
                "respuesta" => true,
                "mensaje" => "SE CAMBIO EL ESTADO CORRECTAMENTE" ,
                "id" => $clase_id
            );
        } catch (\Exception $e){
            $this->em->rollback ();
            $this->em->close ();
            return $response = array (
                "respuesta" => false,
                "mensaje" => "ERROR AL CAMBIAR DE ESTADO." . $e,
                "id" => $clase_id 
            );
        }
    }
    
    public function saveData($formData,$clase) {
        if($clase == 'Application\Entity\Perfil'){
            $SaveDataRepository = new PerfilRepository($this->em);
        }
        else if($clase == 'Application\Entity\ClaSectorEntidad'){
            $SaveDataRepository = new ClaSectorEntidadRepository($this->em);
        }
        else if($clase == 'Application\Entity\ClaTipoTramite'){
            $SaveDataRepository = new ClaTipoTramiteRepository($this->em);
        }
        else if($clase == 'Application\Entity\ClaTipoRamo'){
            $SaveDataRepository = new ClaTipoRamoRepository($this->em);
        }
        else if($clase == 'Application\Entity\ClaTipoCuenta'){
            $SaveDataRepository = new ClaTipoCuentaRepository($this->em);
        }
        else if($clase == 'Application\Entity\ClaTipoBanco'){
            $SaveDataRepository = new ClaTipoBancoRepository($this->em);
        }
        else if($clase == 'Application\Entity\ClaTipoEntidad'){
            $SaveDataRepository = new ClaTipoEntidadRepository($this->em);
        }
        else if($clase == 'Application\Entity\ClaTipoProceso'){
            $SaveDataRepository = new ClaTipoProcesoRepository($this->em);
        }
        else if($clase == 'Application\Entity\ClaGestion'){
            $SaveDataRepository = new ClaGestionRepository($this->em);
        }
        else if($clase == 'Application\Entity\ClaRegional'){
            $SaveDataRepository = new ClaRegionalRepository($this->em);
        }
        return $respuesta = $SaveDataRepository->saveData($formData);
    }
    
    public function getForm($id,$clase) {
        if($clase == 'Application\Entity\Perfil'){
            $data = $this->em->find('Application\Entity\Perfil',$id);
            return $response = array (
                "id" => $data->getId(),
                "nombre" => $data->getNombre(),
                "id_aplicacion" => $data->getIdAplicacion(),
                "estado" => $data->getEstado()
            );
        }
        else if($clase == 'Application\Entity\ClaSectorEntidad'){
            $data = $this->em->find('Application\Entity\ClaSectorEntidad',$id);
            return $response = array (
                "descripcion" => $data->getDescripcion(),
                "sigla" => $data->getSigla(),
                "id" => $data->getId()
            );
        }
        else if($clase == 'Application\Entity\ClaTipoProceso'){
            $data = $this->em->find('Application\Entity\ClaTipoProceso',$id);
            return $response = array (
                "descripcion" => $data->getDescripcion(),
                "sigla" => $data->getSigla(),
                "nombre" => $data->getNombre(),
                "id" => $data->getId()
            );
        }
        else if($clase == 'Application\Entity\ClaTipoBanco'){
            $data = $this->em->find('Application\Entity\ClaTipoBanco',$id);
            return $response = array (
                "banco_id" => $data->getBancoId(),
                "tipo_cuenta_id" => $data->getTipoCuentaId(),
                "numero_cuenta" => $data->getNumeroCuenta(),
                "id" => $data->getId()
            );
        }
        else if($clase == 'Application\Entity\ClaTipoEntidad'){
            $data = $this->em->find('Application\Entity\ClaTipoEntidad',$id);
            return $response = array (
                "descripcion" => $data->getDescripcion(),
                "sigla" => $data->getSigla(),
                "sector_entidad_id" => $data->getSectorEntidadId(),
                "id" => $data->getId()
            );
        }
        else if($clase == 'Application\Entity\ClaTipoRamo'){
            $data = $this->em->find('Application\Entity\ClaTipoRamo',$id);
            return $response = array (
                "descripcion" => $data->getDescripcion(),
                "sigla" => $data->getSigla(),
                "id" => $data->getId()
            );
        }
        else if($clase == 'Application\Entity\ClaTipoCuenta'){
            $data = $this->em->find('Application\Entity\ClaTipoCuenta',$id);
            return $response = array (
                "descripcion" => $data->getDescripcion(),
                "sigla" => $data->getSigla(),
                "id" => $data->getId()
            );
        }
        else if($clase == 'Application\Entity\ClaTipoTramite'){
            $data = $this->em->find('Application\Entity\ClaTramite',$id);
            return $response = array (
                "descripcion" => $data->getDescripcion(),
                "sigla" => $data->getSigla(),
                "costo" => $data->getCosto(),
                "id" => $data->getId()
            );
        }
        else if($clase == 'Application\Entity\ClaGestion'){
            $data = $this->em->find('Application\Entity\ClaGestion',$id);
            return $response = array (
                "gestion" => $data->getGestion(),
            	"regional_id" => $data->getRegionalId(),
                "n_tramite" => $data->getNTramite(),
                "n_modificacion_datos" => $data->getNModificacionDatos(),
                "n_resolucion" => $data->getNResolucion(),
                "id" => $data->getId()
            );
        }
        else if($clase == 'Application\Entity\ClaRegional'){
            $data = $this->em->find('Application\Entity\ClaRegional',$id);
            return $response = array (
                "regional" => $data->getRegional(),
                "direccion" => $data->getDireccion(),
                "telefono" => $data->getTelefono(),
                "fax" => $data->getFax(),
                "id" => $data->getId()
            );
        }
    }
    
}
