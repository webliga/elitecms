<?php

$config = array(
    'is_admin' => false, //Является ли модуль административным (отображение админки)
    'controller' => array(// Настройки контроллеров
        'main' => array(// Имя контроллера
            'action' => array(// Настройки экшна
                'index' => array(// Имя экшна
                    'desc' => 'Просмотр новости', //Описание экшна 
                    'accessType' => array(//Доступ к экшну для пользователя по url
                        'r' => true,
                    ), 
                    'callFromAdmin' => false, // Доступ только из админки по url?
                ),
            ),
            'desc' => 'Просмотр новостей', //Описание контроллера 
        ),
        'tasks' => array(
            'action' => array(
                'index' => array(
                    'desc' => 'Просмотр списка новостей',
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
                    'callFromAdmin' => false,
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
                /*'delete' => array(
                    'desc' => 'Удаление задания',
                    'accessType' => array(
                        'd' => true,
                        ),
                    'callFromAdmin' => true,
                ),*/
            ),
            'desc' => 'Управление задачами',
        ),
    ),
);
?>
