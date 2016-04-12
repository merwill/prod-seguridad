<?php
return array(
    'controllers' => array(
        'invokables' => array(
            //'Perfiles\Controller\Index' => 'Perfiles\Controller\IndexController',
            'Perfiles\Controller\PerfilesRest' => 'Perfiles\Controller\PerfilesRestController'
        ),
    ),
    'router' => array(
        'routes' => array(
//            'perfiles-lista' => array(
//                'type' => 'Zend\Mvc\Router\Http\Segment',
//                'options' => array(
//                    'route' => '/perfiles[/:id]',
//                    //'route' => '/perfiles/listadousuarios',
//                    'defaults' => array(
//                        'controller' => 'Perfiles\Controller\PerfilesRest'
//                    ),
//                ),
//            ),
            'perfil-detalle' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route' => '/perfiles[/:idAplicacion[/:idPerfil[/:idPersona]]]',
                    'defaults' => array(
                        'controller' => 'Perfiles\Controller\PerfilesRest'
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Perfiles' => __DIR__ . '/../view',
        ),
    ),
);
