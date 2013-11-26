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
//Права доступа к модулю main через URL

$config = array(
    'is_admin' => false, //Является ли модуль административным (отображение админки)
    'controller' => array(// Настройки контроллеров
        'main' => array(// Имя контроллера
            'action' => array(// Настройки экшна
                'showDataByPosition' => array(// Имя экшна
                    'desc' => 'Показывать в позиции?', //Описание экшна 
                    'access_type' => 'r', //Доступ к экшну для пользователя по url
                    'call_from_admin' => true, // Доступ только из админки по url?
                ),
            ),
            'desc' => 'Главная страница админки', //Описание контроллера 
        ),
        'menuitems' => array(// Имя контроллера
            'action' => array(// Настройки экшна
                'index' => array(
                    'desc' => 'Просмотр списка пунктов меню',
                    'access_type' => 'r',
                    'call_from_admin' => true,
                ),
                'create' => array(
                    'desc' => 'Создание пункта меню',
                    'access_type' => 'c',
                    'call_from_admin' => true,
                ),
                'edite' => array(
                    'desc' => 'Просмотр настройки пункта меню',
                    'access_type' => 'e',
                    'call_from_admin' => true,
                ),
                'update' => array(
                    'desc' => 'Редактирование/обновление  пункта меню',
                    'access_type' => 'e',
                    'call_from_admin' => true,
                ),                
                'delete' => array(
                    'desc' => 'Удаление  пункта меню',
                    'access_type' => 'd',
                    'call_from_admin' => true,
                ),                
            ),
            'desc' => 'Главная страница списка пунктов меню', //Описание контроллера 
        ),        
    ),
);

?>
