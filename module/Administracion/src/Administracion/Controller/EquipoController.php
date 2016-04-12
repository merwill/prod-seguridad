<?php

namespace Administracion\Controller;

use Application\Controller\BaseController;
use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;

class EquipoController extends AbstractActionController
{
    public function indexAction()
    {
    	
    	//$layout = $this->layout('layout/layout');
        return new ViewModel();
    }

}