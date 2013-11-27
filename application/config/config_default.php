<?php

$config = array(
    'default_template' => array(
        'name' => 'admin',
    //'path' => 'templates',
    ),
    'default_module' => array(
        'name' => 'main',
        'controller' => 'main',
        'action' => 'index',
    ),
    'default_lang' => array(
        'name' => 'ru',
    ),
    'default_classes' => array(
        'user' => array(
            'name' => 'User',
            'path' => 'application/core'
        ),
        'auth' => array(
            'name' => 'Auth',
            'path' => 'application/core'
        ),
        'access' => array(
            'name' => 'Access',
            'path' => 'application/core'
        ),
        'route' => array(
            'name' => 'Route',
            'path' => 'application/core'
        ),
        'request' => array(
            'name' => 'Request',
            'path' => 'application/core'
        ),
        'grammatical' => array(
            'name' => 'Grammatical',
            'path' => 'application/core'
        ),
        'secure' => array(
            'name' => 'Secure',
            'path' => 'application/core'
        ),
        'error' => array(
            'name' => 'Error',
            'path' => 'application/core'
        ),
        'template' => array(
            'name' => 'Template',
            'path' => 'application/core'
        ),
        'html' => array(
            'name' => 'Html',
            'path' => 'application/core'
        ),
        'session' => array(
            'name' => 'Session',
            'path' => 'application/core'
        ),
        'event' => array(
            'name' => 'Event',
            'path' => 'application/core'
        ),        
    ),
    'default_groups' => array(
        'guest' => array(//Группа
            'module' => '*',
            'controller' => '*',
            'action' => '*',
            'access_type' => 'r',
            'access_type_value' => 1,
        ),
        'superadmin' => array(//Группа
            'module' => '*',
            'controller' => '*',
            'action' => '*',
            'access_type' => '*',
            'access_type_value' => 1,
        ),
    ),
    'default_role' => array(
        'user_group' => 'guest',
        'access' => '',
        'path' => array('*'),
    ),
    
);
?>
