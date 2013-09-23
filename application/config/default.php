<?php

$config = array(
    'default_template' => array(
        'name' => 'default',
        'path' => 'template',
    ),
    'default_module' => array(
        'name' => 'main',
        'action' => 'main',
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
