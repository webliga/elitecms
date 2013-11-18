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
    '/news\/?$/' => 'news/main/index/',    
    '/news\/([0-9]+)/' => 'news/main/index/id/$1',
    '/news\/([a-z]+)\/([0-9]+)/' => 'news/main/index/$1/$2',    
    '/news\/create/' => 'news/newsitems/create',
    '/newsitems/' => 'news/newsitems',    
);
?>
