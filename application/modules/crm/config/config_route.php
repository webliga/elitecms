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
    '/crm\/([0-9]+)/' => 'crm/main/index/$1',
    '/crm\/([a-z]+)\/([0-9]+)/' => 'crm/main/index/$2',    
    '/crm\/tasks/' => 'crm/tasks/index', 
    '/crm\/tasks\/index\/create/' => 'crm/tasks/create',
    '/crm\/tasks\/index\/edite/' => 'crm/tasks/edite',
    '/crm\/tasks\/index\/update/' => 'crm/tasks/update',   
    '/crm\/tasks\/index\/delete/' => 'crm/tasks/delete',    
);
?>
