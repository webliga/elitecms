<?php

// Это временный файл, данные настройки нужно вынести в бд
$config = array(
    'groups' => array(
        'guest' => array(//Группа
            'parent_group' => null, //Родительская группа
            'access' => array(
                '*' => array(// Модуль
                    '*' => array(// Контролер модуля
                        '*' => array('r' => true, 'c' => false, 'w' => false, 'e' => false, 'd' => false),
                    ),
                ),
            )
        ),
        'autorized' => array(//Группа
            'parent_group' => 'guest', //Родительская группа
            'access' => array(
                'main' => array(// Модуль
                    'main' => array(// Контролер модуля
                        'create' => array('r' => false, 'c' => true, 'w' => false, 'e' => false, 'd' => true),
                    ),
                ),
            )
        ),
        'moderator' => array(//Группа
            'parent_group' => 'autorized', //Родительская группа
            'access' => array(
                'main' => array(// Модуль
                    'main' => array(// Контролер модуля
                        'edite' => array('r' => false, 'c' => false, 'w' => false, 'e' => true, 'd' => true),
                        'create' => array('r' => false, 'c' => false, 'w' => false, 'e' => false, 'd' => true),
                    ),
                ),
            )
        ),
        'admin' => array(//Группа
            'parent_group' => 'moderator', //Родительская группа
            'access' => array(
                'main' => array(// Модуль
                    'main' => array(// Контролер модуля
                        'write' => array('r' => true, 'c' => false, 'w' => true, 'e' => false, 'd' => true),
                        'create' => array('r' => false, 'c' => true, 'w' => false, 'e' => false, 'd' => false),
                        'edite' => array('r' => false, 'c' => false, 'w' => false, 'e' => true, 'd' => false),
                    ),
                ),
                'admin' => array(// Модуль
                    'main' => array(// Контролер модуля
                        'index' => array('r' => true,),
                        'create' => array('c' => true,),
                        'edite' => array('e' => true,),
                        'delete' => array('d' => true,),
                    ),
                    'modules' => array(// Контролер модуля
                        'write' => array('r' => true, 'c' => false, 'w' => true, 'e' => false, 'd' => true),
                        'create' => array('r' => false, 'c' => true, 'w' => false, 'e' => false, 'd' => false),
                        'edite' => array('r' => false, 'c' => false, 'w' => false, 'e' => true, 'd' => false),
                    ),
                    'menuitems' => array(// Контролер модуля
                        'write' => array('r' => true, 'c' => false, 'w' => true, 'e' => false, 'd' => true),
                        'create' => array('r' => false, 'c' => true, 'w' => false, 'e' => false, 'd' => false),
                        'edite' => array('r' => false, 'c' => false, 'w' => false, 'e' => true, 'd' => false),
                    ),
                    'newsitems' => array(// Контролер модуля
                        'write' => array('w' => true,),
                        'create' => array('c' => true,),
                        'edite' => array('e' => true,),
                    ),
                ),
                'news' => array(// Модуль
                    'newsitems' => array(// Контролер модуля
                        'index' => array('r' => true,),
                        'create' => array('c' => true,),
                        'edite' => array('e' => true,),
                        'delete' => array('d' => true,),
                    ),
                ),
                'category' => array(// Модуль
                    'categoryitems' => array(// Контролер модуля
                        'index' => array('r' => true,),
                        'create' => array('c' => true,),
                        'edite' => array('e' => true,),
                        'delete' => array('d' => true,),
                        'update' => array('e' => true,),
                    ),
                ),
            )
        ),
        'superadmin' => array(//Группа
            'parent_group' => null, //Родительская группа
            'access' => array(
                '*' => array(// Все модули
                    '*' => array(// все контролеры модулей
                        '*' => array(//все екшены контроллеров
                            'r' => true, 'c' => true, 'w' => true, 'e' => true, 'd' => true),
                    ),
                ),
            ),
        ),
    ),
);
?>
