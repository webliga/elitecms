<?php

$config = array(
    'is_admin' => false, //Является ли модуль административным (отображение админки)
    'is_dublicate' => false, //Возможно ли дублировать модуль 
    'controller' => array(// Настройки контроллеров
        'products' => array(// Имя контроллера
            'action' => array(// Настройки экшна
                'index' => array(
                    'desc' => 'Просмотр товара',
                    'access_type' => 'r',
                    'call_from_admin' => true,
                ),
                'create' => array(
                    'desc' => 'Создание товара',
                    'access_type' => 'c',
                    'call_from_admin' => true,
                ),
                'edite' => array(
                    'desc' => 'Просмотр товара в админке',
                    'access_type' => 'e',
                    'call_from_admin' => true,
                ),
                'update' => array(
                    'desc' => 'Сохранение изменений товара',
                    'access_type' => 'e',
                    'call_from_admin' => true,
                ),                
                'delete' => array(
                    'desc' => 'Удаление товара',
                    'access_type' => 'd',
                    'call_from_admin' => true,
                ),
            ),
            
            'desc' => 'Просмотр новостей', //Описание контроллера 
        ),
    ),
);
?>
