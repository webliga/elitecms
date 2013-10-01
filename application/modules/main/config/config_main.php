<?php
/*
 * Нужно переписать примерно так:
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
$config = array(
    'controller' => array(
        'main' => array(
            'action' => array(
                'index' => array(
                    'r' => true, // read
                    'c' => false, // create
                    'w' => false, // write
                    'e' => false, // edite
                    'd' => false, // delete
                ),
                'create' => array(
                    'r' => false,
                    'c' => true,
                    'w' => false,
                    'e' => false,
                    'd' => false,
                ),
                'write' => array(
                    'r' => false,
                    'c' => false,
                    'w' => true,
                    'e' => false,
                    'd' => false,
                ),
                'edite' => array(
                    'r' => false,
                    'c' => false,
                    'w' => false,
                    'e' => true,
                    'd' => false,
                ),
            ),
        ),
        'shop' => array(
            'action' => array(
                'index' => array(
                    'r' => true,
                    'c' => false,
                    'w' => false,
                    'e' => false,
                    'd' => false,
                ),
                'create' => array(
                    'r' => false,
                    'c' => true,
                    'w' => false,
                    'e' => false,
                    'd' => false,
                ), /*
              'write' => array(
              'r' => false,
              'c' => false,
              'w' => true,
              'e' => false,
              'd' => false,
              ),
              'edite' => array(
              'r' => false,
              'c' => false,
              'w' => false,
              'e' => true,
              'd' => false,
              ), */
            ),
        ),
    ),
);
?>
