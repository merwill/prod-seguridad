<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Formulacion\Controller\Index' => 'Formulacion\Controller\IndexController',
            'Formulacion\Controller\Test' => 'Formulacion\Controller\TestController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'formulacion' => array(
                'type'    => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route'    => '/formulacion',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Formulacion\Controller',
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
                        'options' => array(
                            'key_value_delimiter' => '/',
                            'param_delimiter' => '/',
                        )
                    ),
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action[/:param-1[/:param-2]]]]',
                            //'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                //'param-1'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                //'param-2'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),

                   'test' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/test[/:action]',  //[/:id]
                            'constraints' => array(
                                //'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                //'id'     => '[a-zA-Z0-9_-]*',

                            ),
                            'defaults' => array(
                                'controller' => 'Formulacion\Controller\Test',
                                'action'     => 'index',
                            ),
                        ),
                    ),
 /*                   'formulario' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/test/formulario', //[/:action]  //[/:id]
                            'constraints' => array(
                                //'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                //'id'     => '[a-zA-Z0-9_-]*',

                            ),
                            'defaults' => array(
                                'controller' => 'Formulacion\Controller\Test',
                                'action'     => 'formulario',
                            ),
                        ),
                    ),*/
                    /*'test/indexs' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/test[/:action]',  //[/:id]
                            'constraints' => array(
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                //'id'     => '[a-zA-Z0-9_-]*',

                            ),
                            'defaults' => array(
                                'controller' => 'Formulacion\Controller\Test',
                                'action'     => 'index',
                            ),
                        ),
                    ),*/
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        /*'template_path_stack' => array(
            'Formulacion' => __DIR__ . '/../view',
        ),*/
    ),
);
