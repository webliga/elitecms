<?php

$config = array(
    'default_template' => array(
        'name' => 'default',
        'path' => 'template',
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
    ),
    'default_role' => array(
        'user_group' => 'admin',
        'access' => '',
        'path' => array('*'),
    ),
);
?>
