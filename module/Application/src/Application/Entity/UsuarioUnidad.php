<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UsuarioUnidad
 *
 * @ORM\Table(name="usuario_unidad")
 * @ORM\Entity
 */
class UsuarioUnidad
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="usuario_unidad_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_usuario", type="integer", nullable=true)
     */
    private $idUsuario;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_unidad_poa", type="integer", nullable=true)
     */
    private $idUnidadPoa;

    /**
     * @var boolean
     *
     * @ORM\Column(name="estado", type="boolean", nullable=true)
     */
    private $estado;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_unidad", type="integer", nullable=true)
     */
    private $idUnidad;



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
     * Set idUsuario
     *
     * @param integer $idUsuario
     * @return UsuarioUnidad
     */
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    
        return $this;
    }

    /**
     * Get idUsuario
     *
     * @return integer 
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * Set idUnidadPoa
     *
     * @param integer $idUnidadPoa
     * @return UsuarioUnidad
     */
    public function setIdUnidadPoa($idUnidadPoa)
    {
        $this->idUnidadPoa = $idUnidadPoa;
    
        return $this;
    }

    /**
     * Get idUnidadPoa
     *
     * @return integer 
     */
    public function getIdUnidadPoa()
    {
        return $this->idUnidadPoa;
    }

    /**
     * Set estado
     *
     * @param boolean $estado
     * @return UsuarioUnidad
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

    /**
     * Set idUnidad
     *
     * @param integer $idUnidad
     * @return UsuarioUnidad
     */
    public function setIdUnidad($idUnidad)
    {
        $this->idUnidad = $idUnidad;
    
        return $this;
    }

    /**
     * Get idUnidad
     *
     * @return integer 
     */
    public function getIdUnidad()
    {
        return $this->idUnidad;
    }
}