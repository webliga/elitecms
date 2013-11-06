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
                    'accessType' => array(//Доступ к экшну для пользователя по url
                        'r' => true,
                    ), 
                    'callFromAdmin' => false, // Доступ только из админки по url?
                ),
            ),
            'desc' => 'Просмотр контента категории', //Описание контроллера 
        ),
        'categoryitems' => array(
            'action' => array(
                'index' => array(
                    'desc' => 'Просмотр списка категорий',
                    'accessType' => array(
                        'r' => true,
                        ),
                    'callFromAdmin' => true,
                ),
                'create' => array(
                    'desc' => 'Создание категории',
                    'accessType' => array(
                        'c' => true,
                        ),
                    'callFromAdmin' => true,
                ),
                'edite' => array(
                    'desc' => 'Редактирование категории',
                    'accessType' => array(
                        'e' => true,
                        ),
                    'callFromAdmin' => true,
                ),
                'update' => array(
                    'desc' => 'Редактирование категории',
                    'accessType' => array(
                        'e' => true,
                        ),
                    'callFromAdmin' => true,
                ),                
                'delete' => array(
                    'desc' => 'Удаление категории',
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
