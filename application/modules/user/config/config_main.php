<?php

$config = array(
    'is_admin' => false, //Является ли модуль административным (отображение админки)
    'controller' => array(// Настройки контроллеров
        'main' => array(// Имя контроллера
            'action' => array(// Настройки экшна
                'index' => array(// Имя экшна
                    'desc' => 'Просмотр всех пользователей', //Описание экшна 
                    'access_type' => 'r',
                    'call_from_admin' => true, // Доступ только из админки по url?
                ),
                'edite' => array(
                    'desc' => 'Редактирование пользователя',
                    'access_type' => 'e',
                    'call_from_admin' => true,
                ),
                'update' => array(
                    'desc' => 'Редактирование пользователя',
                    'access_type' => 'e',
                    'call_from_admin' => true,
                ),
                'create' => array(
                    'desc' => 'Создание пользователя',
                    'access_type' => 'c',
                    'call_from_admin' => true,
                ),
                'delete' => array(
                    'desc' => 'Удаление пользователя',
                    'access_type' => 'd',
                    'call_from_admin' => true,
                ),
            ),
            'desc' => 'Просмотр новостей', //Описание контроллера 
        ),
        'register' => array(
            'action' => array(
                'create' => array(
                    'desc' => 'Создание задания',
                    'access_type' => 'c',
                    'call_from_admin' => false,
                ),
            ),
            'desc' => 'Управление задачами',
        ),
        'auth' => array(
            'action' => array(
                'index' => array(
                    'desc' => 'Создание задания',
                    'access_type' => 'r',
                    'call_from_admin' => false,
                ),
                'login' => array(
                    'desc' => 'Создание задания',
                    'access_type' => 'r',
                    'call_from_admin' => false,
                ),  
                'logout' => array(
                    'desc' => 'Создание задания',
                    'access_type' => 'r',
                    'call_from_admin' => false,
                ),                 
            ),
            'desc' => 'Управление задачами',
        ),
        'groups' => array(
            'action' => array(
                'index' => array(
                    'desc' => 'Просмотр списка групп',
                    'access_type' => 'r',
                    'call_from_admin' => true,
                ),
                'edite' => array(
                    'desc' => 'Редактирование группы',
                    'access_type' => 'e',
                    'call_from_admin' => true,
                ),
                'update' => array(
                    'desc' => 'Редактирование группы',
                    'access_type' => 'e',
                    'call_from_admin' => true,
                ),
                'create' => array(
                    'desc' => 'Создание группы',
                    'access_type' => 'c',
                    'call_from_admin' => true,
                ),
                'delete' => array(
                    'desc' => 'Удаление группы',
                    'access_type' => 'd',
                    'call_from_admin' => true,
                ),
                'access' => array(
                    'desc' => 'Просмотр прав группы',
                    'access_type' => 'r',
                    'call_from_admin' => true,
                ),
                'accessupdate' => array(
                    'desc' => 'Обновление прав группы',
                    'access_type' => 'e',
                    'call_from_admin' => true,
                ),                
            ),
            'desc' => 'Управление задачами',
        ),

    ),
);
?>
