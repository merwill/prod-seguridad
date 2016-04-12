<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Persona
 *
 * @ORM\Table(name="persona")
 * @ORM\Entity
 */
class Persona
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_persona", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="persona_id_persona_seq", allocationSize=1, initialValue=1)
     */
    private $idPersona;

    /**
     * @var string
     *
     * @ORM\Column(name="paterno", type="string", nullable=true)
     */
    private $paterno;

    /**
     * @var string
     *
     * @ORM\Column(name="materno", type="string", nullable=true)
     */
    private $materno;

    /**
     * @var string
     *
     * @ORM\Column(name="nombres", type="string", nullable=true)
     */
    private $nombres;

    /**
     * @var string
     *
     * @ORM\Column(name="ci", type="string", nullable=true)
     */
    private $ci;

    /**
     * @var string
     *
     * @ORM\Column(name="celular", type="string", nullable=true)
     */
    private $celular;

    /**
     * @var string
     *
     * @ORM\Column(name="correo", type="string", nullable=true)
     */
    private $correo;

    /**
     * @var string
     *
     * @ORM\Column(name="item", type="string", nullable=true)
     */
    private $item;

    /**
     * @var string
     *
     * @ORM\Column(name="cargo", type="string", nullable=true)
     */
    private $cargo;

    /**
     * @var string
     *
     * @ORM\Column(name="puesto", type="string", nullable=true)
     */
    private $puesto;

    /**
     * @var string
     *
     * @ORM\Column(name="unidad", type="string", nullable=true)
     */
    private $unidad;

    /**
     * @var string
     *
     * @ORM\Column(name="entidad", type="string", nullable=true)
     */
    private $entidad;

    /**
     * @var string
     *
     * @ORM\Column(name="entidad_sigla", type="string", nullable=true)
     */
    private $entidadSigla;



    /**
     * Get idPersona
     *
     * @return integer 
     */
    public function getIdPersona()
    {
        return $this->idPersona;
    }

    /**
     * Set paterno
     *
     * @param string $paterno
     * @return Persona
     */
    public function setPaterno($paterno)
    {
        $this->paterno = $paterno;
    
        return $this;
    }

    /**
     * Get paterno
     *
     * @return string 
     */
    public function getPaterno()
    {
        return $this->paterno;
    }

    /**
     * Set materno
     *
     * @param string $materno
     * @return Persona
     */
    public function setMaterno($materno)
    {
        $this->materno = $materno;
    
        return $this;
    }

    /**
     * Get materno
     *
     * @return string 
     */
    public function getMaterno()
    {
        return $this->materno;
    }

    /**
     * Set nombres
     *
     * @param string $nombres
     * @return Persona
     */
    public function setNombres($nombres)
    {
        $this->nombres = $nombres;
    
        return $this;
    }

    /**
     * Get nombres
     *
     * @return string 
     */
    public function getNombres()
    {
        return $this->nombres;
    }

    /**
     * Set ci
     *
     * @param string $ci
     * @return Persona
     */
    public function setCi($ci)
    {
        $this->ci = $ci;
    
        return $this;
    }

    /**
     * Get ci
     *
     * @return string 
     */
    public function getCi()
    {
        return $this->ci;
    }

    /**
     * Set celular
     *
     * @param string $celular
     * @return Persona
     */
    public function setCelular($celular)
    {
        $this->celular = $celular;
    
        return $this;
    }

    /**
     * Get celular
     *
     * @return string 
     */
    public function getCelular()
    {
        return $this->celular;
    }

    /**
     * Set correo
     *
     * @param string $correo
     * @return Persona
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;
    
        return $this;
    }

    /**
     * Get correo
     *
     * @return string 
     */
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * Set item
     *
     * @param string $item
     * @return Persona
     */
    public function setItem($item)
    {
        $this->item = $item;
    
        return $this;
    }

    /**
     * Get item
     *
     * @return string 
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * Set cargo
     *
     * @param string $cargo
     * @return Persona
     */
    public function setCargo($cargo)
    {
        $this->cargo = $cargo;
    
        return $this;
    }

    /**
     * Get cargo
     *
     * @return string 
     */
    public function getCargo()
    {
        return $this->cargo;
    }

    /**
     * Set puesto
     *
     * @param string $puesto
     * @return Persona
     */
    public function setPuesto($puesto)
    {
        $this->puesto = $puesto;
    
        return $this;
    }

    /**
     * Get puesto
     *
     * @return string 
     */
    public function getPuesto()
    {
        return $this->puesto;
    }

    /**
     * Set unidad
     *
     * @param string $unidad
     * @return Persona
     */
    public function setUnidad($unidad)
    {
        $this->unidad = $unidad;
    
        return $this;
    }

    /**
     * Get unidad
     *
     * @return string 
     */
    public function getUnidad()
    {
        return $this->unidad;
    }

    /**
     * Set entidad
     *
     * @param string $entidad
     * @return Persona
     */
    public function setEntidad($entidad)
    {
        $this->entidad = $entidad;
    
        return $this;
    }

    /**
     * Get entidad
     *
     * @return string 
     */
    public function getEntidad()
    {
        return $this->entidad;
    }

    /**
     * Set entidadSigla
     *
     * @param string $entidadSigla
     * @return Persona
     */
    public function setEntidadSigla($entidadSigla)
    {
        $this->entidadSigla = $entidadSigla;
    
        return $this;
    }

    /**
     * Get entidadSigla
     *
     * @return string 
     */
    public function getEntidadSigla()
    {
        return $this->entidadSigla;
    }
}