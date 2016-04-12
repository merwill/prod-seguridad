<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FormularioParametros
 *
 * @ORM\Table(name="formulario_parametros")
 * @ORM\Entity(repositoryClass="Application\Entity\Repositories\FormularioParametrosRepository")
 */
class FormularioParametros
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="formulario_parametros_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="form_name", type="string", length=150, nullable=true)
     */
    private $formName;

    /**
     * @var string
     *
     * @ORM\Column(name="accion", type="string", length=250, nullable=true)
     */
    private $accion;

    /**
     * @var string
     *
     * @ORM\Column(name="metodo", type="string", nullable=true)
     */
    private $metodo;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_accion", type="string", length=250, nullable=true)
     */
    private $tipoAccion;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", nullable=true)
     */
    private $estado;

    /**
     * @var string
     *
     * @ORM\Column(name="autocomplete", type="string", nullable=true)
     */
    private $autocomplete;



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
     * Set formName
     *
     * @param string $formName
     * @return FormularioParametros
     */
    public function setFormName($formName)
    {
        $this->formName = $formName;
    
        return $this;
    }

    /**
     * Get formName
     *
     * @return string 
     */
    public function getFormName()
    {
        return $this->formName;
    }

    /**
     * Set accion
     *
     * @param string $accion
     * @return FormularioParametros
     */
    public function setAccion($accion)
    {
        $this->accion = $accion;
    
        return $this;
    }

    /**
     * Get accion
     *
     * @return string 
     */
    public function getAccion()
    {
        return $this->accion;
    }

    /**
     * Set metodo
     *
     * @param string $metodo
     * @return FormularioParametros
     */
    public function setMetodo($metodo)
    {
        $this->metodo = $metodo;
    
        return $this;
    }

    /**
     * Get metodo
     *
     * @return string 
     */
    public function getMetodo()
    {
        return $this->metodo;
    }

    /**
     * Set tipoAccion
     *
     * @param string $tipoAccion
     * @return FormularioParametros
     */
    public function setTipoAccion($tipoAccion)
    {
        $this->tipoAccion = $tipoAccion;
    
        return $this;
    }

    /**
     * Get tipoAccion
     *
     * @return string 
     */
    public function getTipoAccion()
    {
        return $this->tipoAccion;
    }

    /**
     * Set estado
     *
     * @param string $estado
     * @return FormularioParametros
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    
        return $this;
    }

    /**
     * Get estado
     *
     * @return string 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set autocomplete
     *
     * @param string $autocomplete
     * @return FormularioParametros
     */
    public function setAutocomplete($autocomplete)
    {
        $this->autocomplete = $autocomplete;
    
        return $this;
    }

    /**
     * Get autocomplete
     *
     * @return string 
     */
    public function getAutocomplete()
    {
        return $this->autocomplete;
    }
}