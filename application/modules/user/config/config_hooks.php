<?php

$config = array(
    'before_start' => array(// имя события
        array(
            'module' => 'user',
            'controller' => 'groups',
            'action' => 'hookTest',
        ),
        array(
            'module' => 'user',
            'controller' => 'groups',
            'action' => 'hookTest2',
        ),
    ),
);
?>