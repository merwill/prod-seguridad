<?php

namespace Formulacion;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;


class Module
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
		            __NAMESPACE__ => __DIR__ . '/src/' . str_replace('\\', '/' , __NAMESPACE__),
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }


    public function onBootstrap($e)
    {
        // You may not need to do this if you're doing it elsewhere in your
        // application
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);



    }

/*
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager = $e->getApplication()->getEventManager();

        //Routes dinamicos
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        // Eventos PreDistpach
        $eventManager->getSharedManager()->attach('Zend\Mvc\Controller\AbstractController',
            MvcEvent::EVENT_DISPATCH,
            function(MvcEvent $event){

//             //Render Ajax into view
                $result = $event->getResult();
                if ($result instanceof \Zend\View\Model\ViewModel) {
                    $result->setTerminal($event->getRequest()->isXmlHttpRequest());
                }

               // $result->setTerminal(true);


            });
    }*/
}
