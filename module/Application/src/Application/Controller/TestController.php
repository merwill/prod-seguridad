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
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class TestController extends BaseController
{
    public function indexAction()
    {
       // $op = new \Application\Entity\Repositories\PeiRepository($this->getEntityManager());
        $op = new PeiRepository($this->getEntityManager());
        $res = $op->findAllPei();

        return new ViewModel(array("res"=>$res));
    }

    public function testAction()
    {
        $op = new PeiRepository($this->getEntityManager());
        $res = $op->findAllPei();

        return new ViewModel(array("res"=>$res));
    }
}
