<?php

namespace Application;

use Zend\EventManager\EventInterface;
use Zend\Log\Logger;
use Zend\Log\Writer\FirePhp as FirePhpWriter;
use Zend\ModuleManager\ModuleManager;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

require_once 'vendor/FirePHPCore/FirePHP.class.php';
include_once 'vendor/YepSua/Labs/RIA/jQuery4PHP/YsJQueryAutoloader.php';

class Module
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }


    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }



    public function getServiceConfig() {
        return array (
            'factories' => array (
                // [..] other factories for other serivces left out
                'log' => function ($sm) {
                        $log = new Logger();
                        // $writer = new FirePhpWriter(new FirePhpBridge(new \FirePHP()));
                        $writer = new FirePhpWriter ();
                        $log->addWriter ( $writer );
                        return $log;
                },
                'will' => function ($sm) {
                     return "Wilmer Alvarez";
                 }
            )
        );
    }

    public function init(ModuleManager $moduleManager)
    {
//        $sharedEvents = $moduleManager->getEventManager()->getSharedManager();
//        $sharedEvents->attach(__NAMESPACE__, 'dispatch', function($e) {
//            $config = $e->getApplication()->getConfiguration();
//            $controller = $e->getTarget();
//            $controller->config = $config;
//        });

        //Registro de libreiras Jquery4PHP
        \YsJQueryAutoloader::register();


/*        $serviceManager = $e->getApplication()->getServiceManager();
        $viewModel = $e->getApplication()->getMvcEvent()->getViewModel();

        $myService = $serviceManager->get('MyModule\Service\MyService');

        $viewModel->someVar = $myService->getSomeValue();*/



    }



    public function onBootstrap(MvcEvent $e)
    {
/*
        $serviceManager = $e->getApplication()->getServiceManager();
        $viewModel = $e->getApplication()->getMvcEvent()->getViewModel();

        //$myService = $serviceManager->get('MyModule\Service\MyService');

        $viewModel->someVar = $this->initNavigation();
        */

        //**********************************************************
        $eventManager = $e->getApplication()->getEventManager();
        //Routes dinamicos
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        //var_dump($datosCabecera);

        //$viewModel = $event->getResult();

        //$this->setLayout()

        // Eventos PreDistpach
        $eventManager->getSharedManager()->attach('Zend\Mvc\Controller\AbstractController',
                                                   MvcEvent::EVENT_DISPATCH,
                                                   function(MvcEvent $event){

            //cho  "<script>alert('onDispatchBootstrap')</script>";

            // Redirect
//            $request = $event->getRouteMatch();
//            $m = $request->setParam("module","application");
//            $c = $request->setParam("controller","index");
//            $a = $request->setParam("action","index2");
//            return;


            /**
             * Render switch layout with AJAX request
             */
             $request =  $event->getRequest();
             $viewModel = $event->getResult();

             if($request->isXmlHttpRequest()) {
                 $viewModel->setTerminal($request->isXmlHttpRequest());
             }


//             //Render Ajax into view
          /*   $result = $event->getResult();
             if ($result instanceof \Zend\View\Model\ViewModel) {
                $result->setTerminal($event->getRequest()->isXmlHttpRequest());
             }*/




        });

        /*$e->getTarget()-> la setVariable("someVar","wwwwwwwwwwwwww");

        echo  "<script>alert('onDispatchBootstrap')</script>";*/




    }

//    public function onBootstrap(MvcEvent $e)
//    {
////        $sharedEvents        = $e->getApplication()->getEventManager();
////        $moduleRouteListener = new ModuleRouteListener();
////        $moduleRouteListener->attach($sharedEvents);
//
//        $sharedEvents        = $e->getApplication()->getEventManager()->getSharedManager();
//        $sharedEvents->attach('Zend\Mvc\Controller\AbstractActionController','dispatch',
//            function($e) {
//                $result = $e->getResult();
//                if ($result instanceof \Zend\View\Model\ViewModel) {
//                    //$result->setTerminal($e->getRequest()->isXmlHttpRequest());
//                    //if you want no matter request is, the layout is disabled, you can
//                    //set true : $result->setTerminal(true);
//                }
//            });
//    }

    public function preDispatch()
    {
        //echo  "<script>alert('preDispacht')</script>";

//        $layout = new LayoutSwitch();
//        $layout->indexAction();

       // echo  "<script>alert('preDispacht')</script>";
    }

    public function setLayout(EventInterface $e)
    {
        $request = $e->getRequest();
        $server  = $request->getServer();

        if ($request->isXmlHttpRequest()) {
            $view_model = $e->getViewModel();
            $view_model->setTerminal(true);
        }
    }

    public function initNavigation(){
        $datosCabecera = array(
            "usuario"=>"WILMER",
            "cargo"=>"CARGO",
            "aplicacion"=>"APLICACION",
            "institucion"=>"MEFP(UTI)",
        );

        //var_dump($datosCabecera);

        return $datosCabecera;

        /*
                Layout::getMvcInstance()->assign('whatever', 'foo');

                return;*/
        //$this->view->datosCabeceraView = $datosCabecera;

    }

}
