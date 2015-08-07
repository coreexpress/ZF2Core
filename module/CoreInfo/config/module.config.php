<?php
return array(
    'controllers' => array(
        'invokables' => array(
              'CoreInfo\Controller\Index' => 'CoreInfo\Controller\IndexController'
        ),
    ),
    'router' => array(
        'routes' => array(
            'core-info' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/core-info',
                    'defaults' => array(
                        'controller' => 'CoreInfo\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'core-info' => __DIR__ . '/../view',
        ),
    ),
);
