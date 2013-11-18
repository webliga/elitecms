<?php

$config = array(
    'is_admin' => false, //Является ли модуль административным (отображение админки)
    'controller' => array(// Настройки контроллеров
        'main' => array(// Имя контроллера
            'action' => array(// Настройки экшна
                'index' => array(// Имя экшна
                    'desc' => 'Просмотр всех пользователей', //Описание экшна 
                    'accessType' => array(//Доступ к экшну для пользователя по url
                        'r' => true,
                    ),
                    'callFromAdmin' => true, // Доступ только из админки по url?
                ),
                'edite' => array(
                    'desc' => 'Редактирование пользователя',
                    'accessType' => array(
                        'e' => true,
                    ),
                    'callFromAdmin' => true,
                ),
                'update' => array(
                    'desc' => 'Редактирование пользователя',
                    'accessType' => array(
                        'e' => true,
                    ),
                    'callFromAdmin' => true,
                ),
                'create' => array(
                    'desc' => 'Создание пользователя',
                    'accessType' => array(
                        'c' => true,
                    ),
                    'callFromAdmin' => true,
                ),
                'delete' => array(
                    'desc' => 'Удаление пользователя',
                    'accessType' => array(
                        'd' => true,
                    ),
                    'callFromAdmin' => true,
                ),
            ),
            'desc' => 'Просмотр новостей', //Описание контроллера 
        ),
        'register' => array(
            'action' => array(
                'create' => array(
                    'desc' => 'Создание задания',
                    'accessType' => array(
                        'c' => true,
                    ),
                    'callFromAdmin' => false,
                ),
            ),
            'desc' => 'Управление задачами',
        ),
        'auth' => array(
            'action' => array(
                'index' => array(
                    'desc' => 'Создание задания',
                    'accessType' => array(
                        'r' => true,
                    ),
                    'callFromAdmin' => false,
                ),
                'login' => array(
                    'desc' => 'Создание задания',
                    'accessType' => array(
                        'r' => true,
                    ),
                    'callFromAdmin' => false,
                ),  
                'logout' => array(
                    'desc' => 'Создание задания',
                    'accessType' => array(
                        'r' => true,
                    ),
                    'callFromAdmin' => false,
                ),                 
            ),
            'desc' => 'Управление задачами',
        ),        
        
    ),
);
?>
