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
//Права доступа к модулю main через URL

$config = array(
    'is_admin' => false, //Является ли модуль административным (отображение админки)
    'controller' => array(// Настройки контроллеров
        'main' => array(// Имя контроллера
            'action' => array(// Настройки экшна
                'index' => array(// Имя экшна
                    'desc' => 'Главная админки', //Описание экшна 
                    'accessType' => array(
                        'r' => true,
                    ), //Доступ к экшну для пользователя по url
                    'callFromAdmin' => true, // Доступ только из админки по url?
                ),
            ),
            'desc' => 'Главная страница админки', //Описание контроллера 
        ),
        'menuitems' => array(// Имя контроллера
            'action' => array(// Настройки экшна
                'index' => array(
                    'desc' => 'Просмотр списка пунктов меню',
                    'accessType' => array(
                        'r' => true,
                        ),
                    'callFromAdmin' => true,
                ),
                'create' => array(
                    'desc' => 'Создание пункта меню',
                    'accessType' => array(
                        'c' => true,
                        ),
                    'callFromAdmin' => true,
                ),
                'edite' => array(
                    'desc' => 'Редактирование  пункта меню',
                    'accessType' => array(
                        'e' => true,
                        ),
                    'callFromAdmin' => true,
                ),
                'update' => array(
                    'desc' => 'Редактирование  пункта меню',
                    'accessType' => array(
                        'e' => true,
                        ),
                    'callFromAdmin' => true,
                ),                
                'delete' => array(
                    'desc' => 'Удаление  пункта меню',
                    'accessType' => array(
                        'd' => true,
                        ),
                    'callFromAdmin' => true,
                ),                
            ),
            'desc' => 'Главная страница списка пунктов меню', //Описание контроллера 
        ),        
    ),
);

?>
