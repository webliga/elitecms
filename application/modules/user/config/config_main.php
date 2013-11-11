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
                'create' => array(
                    'desc' => 'Создание пользователя',
                    'accessType' => array(
                        'c' => true,
                    ),
                    'callFromAdmin' => true,
                ),
            ),
            'desc' => 'Просмотр новостей', //Описание контроллера 
        ),
        'tasks' => array(
            'action' => array(
                'index' => array(
                    'desc' => 'Просмотр списка заданий',
                    'accessType' => array(
                        'r' => true,
                    ),
                    'callFromAdmin' => false,
                ),
                'create' => array(
                    'desc' => 'Создание задания',
                    'accessType' => array(
                        'c' => true,
                    ),
                    'callFromAdmin' => true,
                ),
                'edite' => array(
                    'desc' => 'Редактирование задания',
                    'accessType' => array(
                        'e' => true,
                    ),
                    'callFromAdmin' => false,
                ),
                'update' => array(
                    'desc' => 'Редактирование задания',
                    'accessType' => array(
                        'e' => true,
                    ),
                    'callFromAdmin' => false,
                ),
                'delete' => array(
                    'desc' => 'Удаление задания',
                    'accessType' => array(
                        'd' => true,
                    ),
                    'callFromAdmin' => false,
                ),
            ),
            'desc' => 'Управление задачами',
        ),
        'status' => array(
            'action' => array(
                'index' => array(
                    'desc' => 'Просмотр всех статусов',
                    'accessType' => array(
                        'r' => true,
                    ),
                    'callFromAdmin' => false,
                ),
                'create' => array(
                    'desc' => 'Создание статуса',
                    'accessType' => array(
                        'c' => true,
                    ),
                    'callFromAdmin' => false,
                ),
                'edite' => array(
                    'desc' => 'Редактирование статуса',
                    'accessType' => array(
                        'e' => true,
                    ),
                    'callFromAdmin' => false,
                ),
                'update' => array(
                    'desc' => 'Редактирование статуса',
                    'accessType' => array(
                        'e' => true,
                    ),
                    'callFromAdmin' => false,
                ),
                'delete' => array(
                    'desc' => 'Удаление статуса',
                    'accessType' => array(
                        'd' => true,
                    ),
                    'callFromAdmin' => false,
                ),
            ),
            'desc' => 'Управление статусами',
        ),
    ),
);
?>
