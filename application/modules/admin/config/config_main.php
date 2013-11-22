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
    'is_admin' => true, //Является ли модуль административным (отображение админки)
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
        'modules' => array(// Имя контроллера
            'action' => array(// Настройки экшна
                'index' => array(// Имя экшна
                    'desc' => 'Модули', //Описание экшна 
                    'accessType' => array(
                        'r' => true,
                    ), //Доступ к экшну для пользователя по url
                    'callFromAdmin' => true, // Доступ только из админки по url?
                ),
                'create' => array(// Имя экшна
                    'desc' => 'Создание модуля', //Описание экшна 
                    'accessType' => array(
                        'c' => true,
                    ), //Доступ к экшну для пользователя по url
                    'callFromAdmin' => true, // Доступ только из админки по url?
                ),
                'createdublicate' => array(// Имя экшна
                    'desc' => 'Создание модуля', //Описание экшна 
                    'accessType' => array(
                        'c' => true,
                    ), //Доступ к экшну для пользователя по url
                    'callFromAdmin' => true, // Доступ только из админки по url?
                ),                
                'update' => array(// Имя экшна
                    'desc' => 'Создание настройки сайта', //Описание экшна 
                    'accessType' => array(
                        'e' => true,
                    ), //Доступ к экшну для пользователя по url
                    'callFromAdmin' => true, // Доступ только из админки по url?
                ),
                'edite' => array(// Имя экшна
                    'desc' => 'Создание настройки сайта', //Описание экшна 
                    'accessType' => array(
                        'e' => true,
                    ), //Доступ к экшну для пользователя по url
                    'callFromAdmin' => true, // Доступ только из админки по url?
                ),
                'delete' => array(// Имя экшна
                    'desc' => 'Удаление модуля', //Описание экшна 
                    'accessType' => array(
                        'd' => true,
                    ), //Доступ к экшну для пользователя по url
                    'callFromAdmin' => true, // Доступ только из админки по url?
                ),                
            ),
            'desc' => 'Главная страница списка модули', //Описание контроллера 
        ),
        'settings' => array(// Имя контроллера
            'action' => array(// Настройки экшна
                'index' => array(// Имя экшна
                    'desc' => 'Настройки сайта', //Описание экшна 
                    'accessType' => array(
                        'r' => true,
                    ), //Доступ к экшну для пользователя по url
                    'callFromAdmin' => true, // Доступ только из админки по url?
                ),
                'create' => array(// Имя экшна
                    'desc' => 'Создание настройки сайта', //Описание экшна 
                    'accessType' => array(
                        'c' => true,
                    ), //Доступ к экшну для пользователя по url
                    'callFromAdmin' => true, // Доступ только из админки по url?
                ),
                'update' => array(// Имя экшна
                    'desc' => 'Создание настройки сайта', //Описание экшна 
                    'accessType' => array(
                        'e' => true,
                    ), //Доступ к экшну для пользователя по url
                    'callFromAdmin' => true, // Доступ только из админки по url?
                ),
            ),
            'desc' => 'Главная страница списка модули', //Описание контроллера 
        ),
    ),
);
?>
