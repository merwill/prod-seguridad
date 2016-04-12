<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EntidadAplicacion
 *
 * @ORM\Table(name="entidad_aplicacion")
 * @ORM\Entity(repositoryClass="Application\Entity\Repositories\EntidadAplicacionRepository")
 */
class EntidadAplicacion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="entidad_aplicacion_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_entidad", type="integer", nullable=true)
     */
    private $idEntidad;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_aplicacion", type="integer", nullable=true)
     */
    private $idAplicacion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="estado", type="boolean", nullable=true)
     */
    private $estado;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idEntidad
     *
     * @param integer $idEntidad
     * @return EntidadAplicacion
     */
    public function setIdEntidad($idEntidad)
    {
        $this->idEntidad = $idEntidad;
    
        return $this;
    }

    /**
     * Get idEntidad
     *
     * @return integer 
     */
    public function getIdEntidad()
    {
        return $this->idEntidad;
    }

    /**
     * Set idAplicacion
     *
     * @param integer $idAplicacion
     * @return EntidadAplicacion
     */
    public function setIdAplicacion($idAplicacion)
    {
        $this->idAplicacion = $idAplicacion;
    
        return $this;
    }

    /**
     * Get idAplicacion
     *
     * @return integer 
     */
    public function getIdAplicacion()
    {
        return $this->idAplicacion;
    }

    /**
     * Set estado
     *
     * @param boolean $estado
     * @return EntidadAplicacion
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    
        return $this;
    }

    /**
     * Get estado
     *
     * @return boolean 
     */
    public function getEstado()
    {
        return $this->estado;
    }
}