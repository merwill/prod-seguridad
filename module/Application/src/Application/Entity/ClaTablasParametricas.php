<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ClaTablasParametricas
 *
 * @ORM\Table(name="cla_tablas_parametricas")
 * @ORM\Entity
 */
class ClaTablasParametricas
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="cla_tablas_parametricas_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=50, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="module", type="string", length=100, nullable=false)
     */
    private $module;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_tabla", type="integer", nullable=false)
     */
    private $tipoTabla;

    /**
     * @var string
     *
     * @ORM\Column(name="clase", type="string", length=100, nullable=true)
     */
    private $clase;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=150, nullable=true)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="controller", type="string", length=100, nullable=true)
     */
    private $controller;

    /**
     * @var string
     *
     * @ORM\Column(name="action", type="string", length=100, nullable=true)
     */
    private $action;

    /**
     * @var string
     *
     * @ORM\Column(name="column", type="string", nullable=true)
     */
    private $column;

    /**
     * @var string
     *
     * @ORM\Column(name="data", type="string", nullable=true)
     */
    private $data;

    /**
     * @var integer
     *
     * @ORM\Column(name="page", type="integer", nullable=true)
     */
    private $page;

    /**
     * @var string
     *
     * @ORM\Column(name="td_action", type="string", length=100, nullable=true)
     */
    private $tdAction;

    /**
     * @var string
     *
     * @ORM\Column(name="form_name", type="string", length=50, nullable=true)
     */
    private $formName;



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
     * Set nombre
     *
     * @param string $nombre
     * @return ClaTablasParametricas
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    
        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set module
     *
     * @param string $module
     * @return ClaTablasParametricas
     */
    public function setModule($module)
    {
        $this->module = $module;
    
        return $this;
    }

    /**
     * Get module
     *
     * @return string 
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * Set tipoTabla
     *
     * @param integer $tipoTabla
     * @return ClaTablasParametricas
     */
    public function setTipoTabla($tipoTabla)
    {
        $this->tipoTabla = $tipoTabla;
    
        return $this;
    }

    /**
     * Get tipoTabla
     *
     * @return integer 
     */
    public function getTipoTabla()
    {
        return $this->tipoTabla;
    }

    /**
     * Set clase
     *
     * @param string $clase
     * @return ClaTablasParametricas
     */
    public function setClase($clase)
    {
        $this->clase = $clase;
    
        return $this;
    }

    /**
     * Get clase
     *
     * @return string 
     */
    public function getClase()
    {
        return $this->clase;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return ClaTablasParametricas
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    
        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set controller
     *
     * @param string $controller
     * @return ClaTablasParametricas
     */
    public function setController($controller)
    {
        $this->controller = $controller;
    
        return $this;
    }

    /**
     * Get controller
     *
     * @return string 
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * Set action
     *
     * @param string $action
     * @return ClaTablasParametricas
     */
    public function setAction($action)
    {
        $this->action = $action;
    
        return $this;
    }

    /**
     * Get action
     *
     * @return string 
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Set column
     *
     * @param string $column
     * @return ClaTablasParametricas
     */
    public function setColumn($column)
    {
        $this->column = $column;
    
        return $this;
    }

    /**
     * Get column
     *
     * @return string 
     */
    public function getColumn()
    {
        return $this->column;
    }

    /**
     * Set data
     *
     * @param string $data
     * @return ClaTablasParametricas
     */
    public function setData($data)
    {
        $this->data = $data;
    
        return $this;
    }

    /**
     * Get data
     *
     * @return string 
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set page
     *
     * @param integer $page
     * @return ClaTablasParametricas
     */
    public function setPage($page)
    {
        $this->page = $page;
    
        return $this;
    }

    /**
     * Get page
     *
     * @return integer 
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Set tdAction
     *
     * @param string $tdAction
     * @return ClaTablasParametricas
     */
    public function setTdAction($tdAction)
    {
        $this->tdAction = $tdAction;
    
        return $this;
    }

    /**
     * Get tdAction
     *
     * @return string 
     */
    public function getTdAction()
    {
        return $this->tdAction;
    }

    /**
     * Set formName
     *
     * @param string $formName
     * @return ClaTablasParametricas
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
}