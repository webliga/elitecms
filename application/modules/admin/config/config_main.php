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
        'index' => array('r' => true, 'c' => false, 'w' => false, 'e' => false, 'd' => false),
        'create' => array('r' => false, 'c' => true, 'w' => false, 'e' => false, 'd' => false),
        'write' => array('r' => false, 'c' => false, 'w' => true, 'e' => false, 'd' => false),
        'edite' => array('r' => false, 'c' => false, 'w' => false, 'e' => true, 'd' => false),
    ),
    'modules' => array(//Контроллер
        // Действия
        'index' => array('r' => true, 'c' => false, 'w' => false, 'e' => false, 'd' => false),
        'create' => array('r' => false, 'c' => true, 'w' => false, 'e' => false, 'd' => false),
        'update' => array('r' => true, 'c' => false, 'w' => true, 'e' => false, 'd' => false),
        'edite' => array('r' => true, 'c' => false, 'w' => false, 'e' => true, 'd' => false),
        'delete' => array('r' => true, 'c' => false, 'w' => false, 'e' => true, 'd' => false),        
    ),
    'menuitems' => array(//Контроллер
        // Действия
        'index' => array('r' => true, 'c' => false, 'w' => false, 'e' => false, 'd' => false),
        'create' => array('r' => false, 'c' => true, 'w' => false, 'e' => false, 'd' => false),
        'update' => array('r' => true, 'c' => false, 'w' => true, 'e' => false, 'd' => false),
        'edite' => array('r' => true, 'c' => false, 'w' => false, 'e' => true, 'd' => false),
        'delete' => array('r' => true, 'c' => false, 'w' => false, 'e' => true, 'd' => false),        
    ),  
    'categoryitems' => array(//Контроллер
        // Действия
        'index' => array('r' => true, 'c' => false, 'w' => false, 'e' => false, 'd' => false),
        'create' => array('r' => true, 'c' => true, 'w' => false, 'e' => false, 'd' => false),
        'update' => array('r' => true, 'c' => false, 'w' => true, 'e' => false, 'd' => false),
        'edite' => array('r' => true, 'c' => false, 'w' => false, 'e' => true, 'd' => false),
        'delete' => array('r' => true, 'c' => false, 'w' => false, 'e' => true, 'd' => false),        
    ),  
    'newsitems' => array(//Контроллер
        // Действия
        'index' => array('r' => true, 'c' => false, 'w' => false, 'e' => false, 'd' => false),
        'create' => array('r' => true, 'c' => true, 'w' => false, 'e' => false, 'd' => false),
        'update' => array('r' => true, 'c' => false, 'w' => true, 'e' => false, 'd' => false),
        'edite' => array('e' => true, ),
        'delete' => array('r' => true, 'c' => false, 'w' => false, 'e' => true, 'd' => false),        
    ),    
);
?>
