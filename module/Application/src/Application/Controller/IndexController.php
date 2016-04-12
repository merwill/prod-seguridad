<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Application\Entity\Repositories\PeiRepository;
use Application\Entity\Repositories\UtilsRepository;
use MisLibrerias\DbFactory;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Session\Container;
use Zend\View\Model\ViewModel;
use Zend\Debug\Debug;

class IndexController extends BaseController
{
    public function indexAction()
    {
        $session = new Container('datos_sesion');
        $datos_sesion = $session->datos_sesion;
        //Debug::dump($res);

        $viewModel = new ViewModel(array("datos_sesion" => $datos_sesion));
        return $viewModel;
    }

}
