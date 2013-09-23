<?php

$config = array(
'db'=>array(
    'db_type' => 'mysql',
    'db_host' => 'localhost',
    'db_port' => '3306',    
    'db_name' => 'elitecms',
    'db_user' => 'root',
    'db_pass' => '',
    ),
'default_template' => array(
    'name' => 'default',
    'path' => 'template',
),
'default_module' => array(
    'name' => 'main',
    'action'=>'main',
    ),
'default_classes'=> array(
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