<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Usuarios\Controller\Index' => 'Usuarios\Controller\IndexController',
            'Usuarios\Controller\ServicioRest' => 'Usuarios\Controller\ServicioRestController',
        ),
    ),
    'router' => array(
        'routes' => array(
/*        		'servicio-rest' => array(
        				'type' => 'Zend\Mvc\Router\Http\Segment',
        				'options' => array(
        						'route' => '/servicio-rest/index[/:id]',
        						'defaults' => array(
        								'controller' => 'Usuarios\Controller\ServicioRest'
        						),
        				),
        		),*/

/*                'perfiles' => array(
                    'type' => 'Zend\Mvc\Router\Http\Segment',
                    'options' => array(
                        'route' => '/acceso/users/perfiles',
                        'defaults' => array(
                            'controller' => 'Usuarios\Controller\Perfiles'
                        ),
                    ),
                ),*/
                'usuarios' => array(
                    'type'    => 'Literal',
                    'options' => array(
                        // Change this to something specific to your module
                        'route'    => '/usuarios',
                        'defaults' => array(
                            // Change this value to reflect the namespace in which
                            // the controllers for your module are found
                            '__NAMESPACE__' => 'Usuarios\Controller',
                            'controller'    => 'Index',
                            'action'        => 'index',
                        ),
                    ),
                    'may_terminate' => true,
                    'child_routes' => array(
                        // This route is a sane default when developing a module;
                        // as you solidify the routes for your module, however,
                        // you may want to remove it and replace it with more
                        // specific routes.
                        'default' => array(
                            'type'    => 'Segment',
                            'options' => array(
                                'route'    => '/[:controller[/:action]]',
                                'constraints' => array(
                                    'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                    'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                ),
                                'defaults' => array(
                                ),
                            ),
                        ),
                    ),
                ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Usuarios' => __DIR__ . '/../view',
        ),
    ),
);
