<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FormularioObjetos
 *
 * @ORM\Table(name="formulario_objetos")
 * @ORM\Entity(repositoryClass="Application\Entity\Repositories\FormularioObjetosRepository")
 */
class FormularioObjetos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="formulario_objetos_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="orden", type="integer", nullable=true)
     */
    private $orden;

    /**
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=250, nullable=true)
     */
    private $label;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=250, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="object_type", type="string", length=100, nullable=true)
     */
    private $objectType;

    /**
     * @var string
     *
     * @ORM\Column(name="size", type="string", nullable=true)
     */
    private $size;

    /**
     * @var integer
     *
     * @ORM\Column(name="maxlength", type="integer", nullable=true)
     */
    private $maxlength;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=250, nullable=true)
     */
    private $value;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=250, nullable=true)
     */
    private $title;

    /**
     * @var boolean
     *
     * @ORM\Column(name="readonly", type="boolean", nullable=true)
     */
    private $readonly;

    /**
     * @var string
     *
     * @ORM\Column(name="ondimamic", type="string", length=250, nullable=true)
     */
    private $ondimamic;

    /**
     * @var boolean
     *
     * @ORM\Column(name="disabled", type="boolean", nullable=true)
     */
    private $disabled;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_validacion", type="string", length=100, nullable=true)
     */
    private $tipoValidacion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="required", type="boolean", nullable=true)
     */
    private $required;

    /**
     * @var string
     *
     * @ORM\Column(name="class", type="string", length=150, nullable=true)
     */
    private $class;

    /**
     * @var string
     *
     * @ORM\Column(name="campos", type="string", length=150, nullable=true)
     */
    private $campos;

    /**
     * @var boolean
     *
     * @ORM\Column(name="estado", type="boolean", nullable=true)
     */
    private $estado;

    /**
     * @var string
     *
     * @ORM\Column(name="error_message", type="string", length=250, nullable=true)
     */
    private $errorMessage;

    /**
     * @var string
     *
     * @ORM\Column(name="placeholder", type="string", length=100, nullable=true)
     */
    private $placeholder;

    /**
     * @var \Application\Entity\FormularioParametros
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\FormularioParametros")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="form_param_id", referencedColumnName="id")
     * })
     */
    private $formParam;



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
     * Set orden
     *
     * @param integer $orden
     * @return FormularioObjetos
     */
    public function setOrden($orden)
    {
        $this->orden = $orden;
    
        return $this;
    }

    /**
     * Get orden
     *
     * @return integer 
     */
    public function getOrden()
    {
        return $this->orden;
    }

    /**
     * Set label
     *
     * @param string $label
     * @return FormularioObjetos
     */
    public function setLabel($label)
    {
        $this->label = $label;
    
        return $this;
    }

    /**
     * Get label
     *
     * @return string 
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return FormularioObjetos
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set objectType
     *
     * @param string $objectType
     * @return FormularioObjetos
     */
    public function setObjectType($objectType)
    {
        $this->objectType = $objectType;
    
        return $this;
    }

    /**
     * Get objectType
     *
     * @return string 
     */
    public function getObjectType()
    {
        return $this->objectType;
    }

    /**
     * Set size
     *
     * @param string $size
     * @return FormularioObjetos
     */
    public function setSize($size)
    {
        $this->size = $size;
    
        return $this;
    }

    /**
     * Get size
     *
     * @return string 
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set maxlength
     *
     * @param integer $maxlength
     * @return FormularioObjetos
     */
    public function setMaxlength($maxlength)
    {
        $this->maxlength = $maxlength;
    
        return $this;
    }

    /**
     * Get maxlength
     *
     * @return integer 
     */
    public function getMaxlength()
    {
        return $this->maxlength;
    }

    /**
     * Set value
     *
     * @param string $value
     * @return FormularioObjetos
     */
    public function setValue($value)
    {
        $this->value = $value;
    
        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return FormularioObjetos
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set readonly
     *
     * @param boolean $readonly
     * @return FormularioObjetos
     */
    public function setReadonly($readonly)
    {
        $this->readonly = $readonly;
    
        return $this;
    }

    /**
     * Get readonly
     *
     * @return boolean 
     */
    public function getReadonly()
    {
        return $this->readonly;
    }

    /**
     * Set ondimamic
     *
     * @param string $ondimamic
     * @return FormularioObjetos
     */
    public function setOndimamic($ondimamic)
    {
        $this->ondimamic = $ondimamic;
    
        return $this;
    }

    /**
     * Get ondimamic
     *
     * @return string 
     */
    public function getOndimamic()
    {
        return $this->ondimamic;
    }

    /**
     * Set disabled
     *
     * @param boolean $disabled
     * @return FormularioObjetos
     */
    public function setDisabled($disabled)
    {
        $this->disabled = $disabled;
    
        return $this;
    }

    /**
     * Get disabled
     *
     * @return boolean 
     */
    public function getDisabled()
    {
        return $this->disabled;
    }

    /**
     * Set tipoValidacion
     *
     * @param string $tipoValidacion
     * @return FormularioObjetos
     */
    public function setTipoValidacion($tipoValidacion)
    {
        $this->tipoValidacion = $tipoValidacion;
    
        return $this;
    }

    /**
     * Get tipoValidacion
     *
     * @return string 
     */
    public function getTipoValidacion()
    {
        return $this->tipoValidacion;
    }

    /**
     * Set required
     *
     * @param boolean $required
     * @return FormularioObjetos
     */
    public function setRequired($required)
    {
        $this->required = $required;
    
        return $this;
    }

    /**
     * Get required
     *
     * @return boolean 
     */
    public function getRequired()
    {
        return $this->required;
    }

    /**
     * Set class
     *
     * @param string $class
     * @return FormularioObjetos
     */
    public function setClass($class)
    {
        $this->class = $class;
    
        return $this;
    }

    /**
     * Get class
     *
     * @return string 
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Set campos
     *
     * @param string $campos
     * @return FormularioObjetos
     */
    public function setCampos($campos)
    {
        $this->campos = $campos;
    
        return $this;
    }

    /**
     * Get campos
     *
     * @return string 
     */
    public function getCampos()
    {
        return $this->campos;
    }

    /**
     * Set estado
     *
     * @param boolean $estado
     * @return FormularioObjetos
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
     * Set errorMessage
     *
     * @param string $errorMessage
     * @return FormularioObjetos
     */
    public function setErrorMessage($errorMessage)
    {
        $this->errorMessage = $errorMessage;
    
        return $this;
    }

    /**
     * Get errorMessage
     *
     * @return string 
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * Set placeholder
     *
     * @param string $placeholder
     * @return FormularioObjetos
     */
    public function setPlaceholder($placeholder)
    {
        $this->placeholder = $placeholder;
    
        return $this;
    }

    /**
     * Get placeholder
     *
     * @return string 
     */
    public function getPlaceholder()
    {
        return $this->placeholder;
    }

    /**
     * Set formParam
     *
     * @param \Application\Entity\FormularioParametros $formParam
     * @return FormularioObjetos
     */
    public function setFormParam(\Application\Entity\FormularioParametros $formParam = null)
    {
        $this->formParam = $formParam;
    
        return $this;
    }

    /**
     * Get formParam
     *
     * @return \Application\Entity\FormularioParametros 
     */
    public function getFormParam()
    {
        return $this->formParam;
    }
}