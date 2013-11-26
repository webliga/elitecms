<?php

$config = array(
    'is_admin' => false, //Является ли модуль административным (отображение админки)
    'controller' => array(// Настройки контроллеров
        'main' => array(// Имя контроллера
            'action' => array(// Настройки экшна
                 'showDataByPosition' => array(// Имя экшна
                    'desc' => 'Показывать  в позиции?', //Описание экшна 
                    'access_type' => 'r', 
                    'call_from_admin' => false, // Доступ только из админки по url?
                ),               
                'index' => array(// Имя экшна
                    'desc' => 'Просмотр новости', //Описание экшна 
                    'access_type' => 'r', 
                    'call_from_admin' => false, // Доступ только из админки по url?
                ),
            ),
            
            'desc' => 'Просмотр новостей', //Описание контроллера 
        ),
        'newsitems' => array(
            'action' => array(
                'index' => array(
                    'desc' => 'Просмотр списка новостей',
                    'access_type' => 'r',
                    'call_from_admin' => true,
                ),
                'create' => array(
                    'desc' => 'Создание новости',
                    'access_type' => 'c',
                    'call_from_admin' => true,
                ),
                'edite' => array(
                    'desc' => 'Просмотр настроек новости',
                    'access_type' => 'e',
                    'call_from_admin' => true,
                ),
                'update' => array(
                    'desc' => 'Редактирование/обновление новости',
                    'access_type' => 'e',
                    'call_from_admin' => true,
                ),                
                'delete' => array(
                    'desc' => 'Удаление новости',
                    'access_type' => 'd',
                    'call_from_admin' => true,
                ),
            ),
            'desc' => 'Управление новостями',
        ),
    ),
);
?>
