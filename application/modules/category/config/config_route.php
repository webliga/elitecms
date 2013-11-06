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
$config = array(
    '/category\/([0-9]+)/' => 'category/main/index/$1',
    '/category\/([a-z]+)\/([0-9]+)/' => 'category/main/index/$2',
    '/category\/create/' => 'category/categoryitems/create',
    '/categoryitems/' => 'category/categoryitems',
);
?>
