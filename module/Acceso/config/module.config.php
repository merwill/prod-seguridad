<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Acceso;

return array(
    'router' => array(
        'routes' => array(
            'users' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route' => '/acceso/users[/:id]',
                    'defaults' => array(
                        //'controller' => 'Acceso\Controller\Index'
                        'controller' => 'Usuarios\Controller\ServicioRest'
                    ),
                ),
            ),
            'login' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/acceso/users/login',
                    'defaults' => array(
                        'controller' => 'Acceso\Controller\Login'
                    ),
                ),
            ),


        ),
    ),
    'di' => array(
        'services' => array(
            'Acceso\Model\UsersTable' => 'Acceso\Model\UsersTable',
            'Acceso\Model\UserStatusesTable' => 'Acceso\Model\UserStatusesTable',
            'Acceso\Model\UserLinksTable' => 'Acceso\Model\UserLinksTable',
            'Acceso\Model\UserImagesTable' => 'Acceso\Model\UserImagesTable',
            'Acceso\Model\UserCommentsTable' => 'Acceso\Model\UserCommentsTable',
        )
    ),
    'controllers' => array(
        'invokables' => array(
            'Acceso\Controller\Index' => 'Acceso\Controller\IndexController',
            'Acceso\Controller\Login' => 'Acceso\Controller\LoginController',
        ),
    ),
    
    
    'doctrine' => array(
    		// 1) for Aithentication
    		'authentication' => array( // this part is for the Auth adapter from DoctrineModule/Authentication
    				'orm_default' => array(
    						'object_manager' => 'Doctrine\ORM\EntityManager',
    						// object_repository can be used instead of the object_manager key
    						'identity_class' => 'Application\Entity\Usuario', //'Application\Entity\User',
    						'identity_property' => 'usrName', // 'username', // 'email',
    						'credential_property' => 'usrPassword', // 'password',
    						'credential_callable' => function(\Application\Entity\Usuario $user, $passwordGiven) { // not only User
    						// return my_awesome_check_test($user->getPassword(), $passwordGiven);
    				// echo '<h1>callback user->getPassword = ' .$user->getPassword() . ' passwordGiven = ' . $passwordGiven . '</h1>';
    				//- if ($user->getPassword() == md5($passwordGiven)) { // original
    				// ToDo find a way to access the Service Manager and get the static salt from config array
    				//if ($user->getUsrPassword() == md5('aFGQ475SDsdfsaf2342' . $passwordGiven . $user->getUsrPasswordSalt()) &&
    				//	$user->getUsrActive() == 1) {
    				if (true){
    					return true;
    				}
    				else {
    					return false;
    				}
    				},
    				),
    ),
    
    // 2) standard configuration for the ORM from https://github.com/doctrine/DoctrineORMModule
    				// http://www.jasongrimes.org/2012/01/using-doctrine-2-in-zend-framework-2/
    				// ONLY THIS IS REQUIRED IF YOU USE Doctrine in the module
    				'driver' => array(
    						// defines an annotation driver with two paths, and names it `my_annotation_driver`
    				//            'my_annotation_driver' => array(
    						__NAMESPACE__ . '_driver' => array(
    								'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
    								'cache' => 'array',
    								'paths' => array(
    										// __DIR__ . '/../module/AuthDoctrine/src/AuthDoctrine/Entity' // 'path/to/my/entities',
    										__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity',
    										// 'H:\PortableApps\PortableGit\projects\btk\module\Auth\src\Auth\Entity' // Stoyan added to use doctrine in Auth module
    						//-					__DIR__ . '/../../Auth/src/Auth/Entity', // Stoyan added to use doctrine in Auth module
    										// 'another/path'
    								),
    						),
    
    						// default metadata driver, aggregates all other drivers into a single one.
    						// Override `orm_default` only if you know what you're doing
    						'orm_default' => array(
    								'drivers' => array(
    										// register `my_annotation_driver` for any entity under namespace `My\Namespace`
    										// 'My\Namespace' => 'my_annotation_driver'
    										// 'AuthDoctrine' => 'my_annotation_driver'
    										__NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver',
    						//-					'Auth\Entity' => __NAMESPACE__ . '_driver' // Stoyan added to allow the module Auth also to use Doctrine
    								)
    						)
    				)
    ),
);