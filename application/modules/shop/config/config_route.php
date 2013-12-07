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
    '/shop\/?$/' => 'shop/main/index/',    
    '/shop\/([0-9]+)/' => 'shop/main/index/id/$1',
    '/shop\/([a-z]+)\/([0-9]+)/' => 'shop/main/index/$1/$2',    
    '/shop\/products\/?$/' => 'shop/products/index', 
    '/shop\/create/' => 'shop/products/create',
    '/shop\/products\/edite/' => 'shop/products/edite', 
    
);
?>
