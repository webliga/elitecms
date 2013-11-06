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

$config = array(
    'is_admin' => true, //Является ли модуль административным (отображение админки)
    'controller' => array(// Настройки контроллеров
        'main' => array(// Имя контроллера
            'action' => array(// Настройки экшна
                'index' => array(// Имя экшна
                    'desc' => 'Главная админки', //Описание экшна 
                    'accessType' => array(
                        'r' => true,
                    ), //Доступ к экшну для пользователя по url
                    'callFromAdmin' => true, // Доступ только из админки по url?
                ),
            ),
            'desc' => 'Главная страница админки', //Описание контроллера 
        ),
        'modules' => array(// Имя контроллера
            'action' => array(// Настройки экшна
                'index' => array(// Имя экшна
                    'desc' => 'Модули', //Описание экшна 
                    'accessType' => array(
                        'r' => true,
                    ), //Доступ к экшну для пользователя по url
                    'callFromAdmin' => true, // Доступ только из админки по url?
                ),
                'create' => array(// Имя экшна
                    'desc' => 'Создание модуля', //Описание экшна 
                    'accessType' => array(
                        'c' => true,
                    ), //Доступ к экшну для пользователя по url
                    'callFromAdmin' => true, // Доступ только из админки по url?
                ),                
            ),
            'desc' => 'Главная страница списка модули', //Описание контроллера 
        ),        
    ),
);

?>
