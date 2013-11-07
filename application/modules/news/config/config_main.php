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
        'newsitems' => array(
            'action' => array(
                'index' => array(
                    'desc' => 'Просмотр списка новостей',
                    'accessType' => array(
                        'r' => true,
                        ),
                    'callFromAdmin' => true,
                ),
                'create' => array(
                    'desc' => 'Создание новости',
                    'accessType' => array(
                        'c' => true,
                        ),
                    'callFromAdmin' => true,
                ),
                'edite' => array(
                    'desc' => 'Редактирование новости',
                    'accessType' => array(
                        'e' => true,
                        ),
                    'callFromAdmin' => true,
                ),
                'update' => array(
                    'desc' => 'Редактирование новости',
                    'accessType' => array(
                        'e' => true,
                        ),
                    'callFromAdmin' => true,
                ),                
                'delete' => array(
                    'desc' => 'Удаление новости',
                    'accessType' => array(
                        'd' => true,
                        ),
                    'callFromAdmin' => true,
                ),
            ),
            'desc' => 'Управление новостями',
        ),
    ),
);
?>
