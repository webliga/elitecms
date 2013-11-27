<?php

$config = array(
    'before_start' => array(// имя события
        array(
            'module' => 'news',
            'controller' => 'main',
            'action' => 'hookTest',
        ),
        array(
            'module' => 'news',
            'controller' => 'main',
            'action' => 'hookTest2',
        ),
    ),
);
?>