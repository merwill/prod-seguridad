<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AplicacionPerfil
 *
 * @ORM\Table(name="aplicacion_perfil")
 * @ORM\Entity
 */
class AplicacionPerfil
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="aplicacion_perfil_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_aplicacion", type="integer", nullable=true)
     */
    private $idAplicacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_perfil", type="integer", nullable=true)
     */
    private $idPerfil;

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
     * Set idAplicacion
     *
     * @param integer $idAplicacion
     * @return AplicacionPerfil
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
     * Set idPerfil
     *
     * @param integer $idPerfil
     * @return AplicacionPerfil
     */
    public function setIdPerfil($idPerfil)
    {
        $this->idPerfil = $idPerfil;
    
        return $this;
    }

    /**
     * Get idPerfil
     *
     * @return integer 
     */
    public function getIdPerfil()
    {
        return $this->idPerfil;
    }

    /**
     * Set estado
     *
     * @param boolean $estado
     * @return AplicacionPerfil
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