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
    'is_admin' => false, //Является ли модуль административным (отображение админки)
    'controller' => array(// Настройки контроллеров
        'main' => array(// Имя контроллера
            'action' => array(// Настройки экшна
                'index' => array(// Имя экшна
                    'desc' => 'Просмотр категории', //Описание экшна 
                    'access_type' => 'r', 
                    'call_from_admin' => false, // Доступ только из админки по url?
                ),
            ),
            'desc' => 'Просмотр контента категории', //Описание контроллера 
        ),
        'categoryitems' => array(
            'action' => array(
                'index' => array(
                    'desc' => 'Просмотр списка категорий',
                    'access_type' => 'r',
                    'call_from_admin' => true,
                ),
                'create' => array(
                    'desc' => 'Создание категории',
                    'access_type' => 'c',
                    'call_from_admin' => true,
                ),
                'edite' => array(
                    'desc' => 'Редактирование категории',
                    'access_type' => 'e',
                    'call_from_admin' => true,
                ),
                'update' => array(
                    'desc' => 'Редактирование категории',
                    'access_type' => 'e',
                    'call_from_admin' => true,
                ),                
                'delete' => array(
                    'desc' => 'Удаление категории',
                    'access_type' => 'd',
                    'call_from_admin' => true,
                ),
            ),
            'desc' => 'Управление новостями',
        ),
    ),
);
?>
