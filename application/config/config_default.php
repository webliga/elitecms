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
    ),
);
?>
