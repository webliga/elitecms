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
    'main' => array(//Контроллер
        // Действия
        'index' =>  array('r' => true,),
        'create' => array('c' => true,),
        'write' =>  array('w' => true,),
        'edite' =>  array('e' => true,),
    ),
    'newsitems' => array(//Контроллер
        // Действия
        'index' =>  array('r' => true,),
        'create' => array('c' => true,),
        'write' =>  array('w' => true,),
        'edite' =>  array('e' => true,),
    ),
);
?>
