<?php

namespace Formulacion\Controller;

use Application\Controller\BaseController;
use Zend\View\Model\ViewModel;

class IndexController extends BaseController
{
    public function indexAction()
    {
        return new ViewModel();
    }

}
