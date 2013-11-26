<?php

$config = array(
    'is_admin' => false, //Является ли модуль административным (отображение админки)
    'controller' => array(// Настройки контроллеров
        'main' => array(// Имя контроллера
            'action' => array(// Настройки экшна
                'index' => array(// Имя экшна
                    'desc' => 'Просмотр новости', //Описание экшна 
                    'access_type' => 'r',
                    'call_from_admin' => false, // Доступ только из админки по url?
                ),
            ),
            'desc' => 'Просмотр новостей', //Описание контроллера 
        ),
        'tasks' => array(
            'action' => array(
                'index' => array(
                    'desc' => 'Просмотр списка заданий',
                    'access_type' => 'r',
                    'call_from_admin' => false,
                ),
                'create' => array(
                    'desc' => 'Создание задания',
                    'access_type' => 'c',
                    'call_from_admin' => false,
                ),
                'edite' => array(
                    'desc' => 'Редактирование задания',
                    'access_type' => 'e',
                    'call_from_admin' => false,
                ),
                'update' => array(
                    'desc' => 'Редактирование задания',
                    'access_type' => 'e',
                    'call_from_admin' => false,
                ),
                'delete' => array(
                    'desc' => 'Удаление задания',
                    'access_type' => 'd',
                    'call_from_admin' => false,
                ),
            ),
            'desc' => 'Управление задачами',
        ),
        'status' => array(
            'action' => array(
                'index' => array(
                    'desc' => 'Просмотр всех статусов',
                    'access_type' => 'r',
                    'call_from_admin' => false,
                ),
                'create' => array(
                    'desc' => 'Создание статуса',
                    'access_type' => 'c',
                    'call_from_admin' => false,
                ),
                'edite' => array(
                    'desc' => 'Редактирование статуса',
                    'access_type' => 'e',
                    'call_from_admin' => false,
                ),
                'update' => array(
                    'desc' => 'Редактирование статуса',
                    'access_type' => 'e',
                    'call_from_admin' => false,
                ),
                'delete' => array(
                    'desc' => 'Удаление статуса',
                    'access_type' => 'd',
                    'call_from_admin' => false,
                ),
            ),
            'desc' => 'Управление статусами',
        ),
    ),
);
?>
