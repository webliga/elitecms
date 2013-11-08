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
    '/Crm\/([0-9]+)/' => 'Crm/main/$1',
    '/Crm\/([a-z]+)\/([0-9]+)/' => 'Crm/main/$2',    
    '/Crm\/create/' => 'Crm/Crmitems/create',
    '/Crmitems/' => 'Crm/Crmitems',    
);
?>
