<?php

/*
 * Нужно подумать  переписать ли примерно так?
 * $config = array(
 * 'r' => array(
 *      'main' => array('index'),
 *      'shop' => array('index'),
 *   ),
 * 
 * 'c' => array(
 *      'main' => array('create'),
 *      'shop' => array('create'),
 *   ),
 * 
 * 'w' => array(
 *      'main' => array('write'),
 *   ),
 * 
 * 'e' => array(
 *      'main' => array('edite'),
 *   ),  
 * 
 * 'd' => array(), 
 * 
 * );
 * 
 * 
 * 
 * 
 */
//Права доступа к модулю main
//
$config = array(
    '/user\/([0-9]+)/' => 'user/main/$1',
    '/user\/?$/' => 'user/main/index',
    '/user\/([a-z]+)\/([0-9]+)/' => 'user/main/$2',
    '/user\/create/' => 'user/main/create',
    '/user\/edite/' => 'user/main/edite',
    '/user\/update/' => 'user/main/update',
    '/user\/delete/' => 'user/main/delete',    
    '/register\/create/' => 'register/create',
    '/register/' => 'user/register/create',
);
?>
