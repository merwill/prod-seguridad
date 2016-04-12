<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return array(
    'static_salt' => 'aFGQ475SDsdfsaf2342', // was moved from module.config.php here to allow all modules to use it
    'db' => array(
        'driver' => 'Pdo',
        'dsn' => 'mysql:dbname=sn;host=192.168.0.110',
        'driver_options' => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
        ),
    ),
    'view_manager' => array(
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
  /*  'doctrine' => array(
        'connection' => array(
            'orm_poappto' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOPgSql\Driver',
                'params' => array(
                    'host'     => 'localhost',
                    'port'     => '5432',
                    'user'     => 'postgres',
                    'password' => 'admin',
                    'dbname'   => 'poa-ppto',
                )
            ),
            // Here we can define several configuration alternatives,
            //use different keys for each one
            /*'orm_default'=> array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOPgSql\Driver',
                'params' => array(
                    'host'     => 'localhost',
                    'port'     => '5432',
                    'user'     => 'postgres',
                    'password' => 'admin',
                    'dbname'   => 'poa-ppto',
                )
            ),
        ),*/
        // now you define the entity manager configuration
  /*      'entitymanager' => array(
            'orm_default' => array(
                'connection'    => 'orm_default',
                'configuration' => 'orm_default'
            ),
            //This is the alternative config
            'orm_poappto' => array(
                'connection'    => 'orm_poappto',
                'configuration' => 'orm_poappto'
            )
        ),*/
        //   We need to define now the 'orm_poa_ppto' config,
        // the default one is already defined at the level of
        // doctrine module code
       /* 'configuration' => array(
            'orm_poappto' => array(
               // 'metadata_cache'    => 'array',
                //'query_cache'       => 'array',
                //'result_cache'      => 'array',
                'driver'            => 'orm_poappto', // This driver will be defined later
                //'generate_proxies'  => true,
                //'proxy_dir'         => 'data/DoctrineORMModule/Proxy',
                //'proxy_namespace'   => 'DoctrineORMModule\Proxy',
                //'filters'           => array()
            )
        ),*/
    /*),*/
);