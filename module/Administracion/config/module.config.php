<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Administracion\Controller\Index' => 'Administracion\Controller\IndexController',
            'Administracion\Controller\Equipo' => 'Administracion\Controller\EquipoController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'administracion' => array(
                'type'    => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route'    => '/administracion',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Administracion\Controller',
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
                	'wildcard' => array(
                			'type' => 'Wildcard',
                	),
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action[/:id[/:page]]]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            		'page' => '[0-9]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                	'paginator' => array(
                		'type'    => 'Segment',
                		'options' => array(
                			'route'    => '/[:controller[/page/:page[/id/:id]]]',
                			'constraints' => array(
                				'page' => '[0-9]*',
                			),
                			'defaults' => array(
                				'__NAMESPACE__' => 'Administracion\Controller',
                				'controller'    => 'Index',
                        		'action'        => 'parametrica',
                			),
                		),
                	),
//                 	'equipo' => array(
//                 		'type'    => 'Segment',
//                 		'options' => array(
//                 			'route'    => '/equipo[/:action]',
//                             'constraints' => array(
//                                 'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
//                                 'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
//                             ),
// 							'defaults' => array(
//                 				'__NAMESPACE__' => 'Administracion\Controller',
//                 				'controller'    => 'Equipo',
//                         		'action'        => 'index',
//                 			),
//                 		),
//                 	),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Administracion' => __DIR__ . '/../view',
        ),
    	'template_map' => array(
    		'paginator-slide' => __DIR__ . '/../view/layout/slidePaginator.phtml',
    	),
    ),
);
