<?php

$config = array(
    'groups' => array(
        'guest' => array(
            'parent_group' => null,
            'actions' => array(
                '*' => array(// Все модули
                    '*' => array(// все контролеры модулей
                        '*' => array(//все екшены контроллеров
                            'r' => true, // только читать
                            'c' => false,
                            'w' => false,
                            'e' => false,
                            'd' => false,
                        ),
                    ),
                ),
            )
        ),
        'autorized' => array(
            'parent_group' => 'guest',
            'actions' => array(
                'main' => array(
                    'main' => array(
                        'create' => array(
                            'r' => false,
                            'c' => true,
                            'w' => false,
                            'e' => false,
                            'd' => true,
                        ),
                    ),
                ),
            )
        ),
        'moderator' => array(
            'parent_group' => 'autorized',
            'actions' => array(
                'main' => array(
                    'main' => array(
                        'edite' => array(
                            'r' => false,
                            'c' => false,
                            'w' => false,
                            'e' => true,
                            'd' => true,
                        ),
                        'create' => array(
                            'r' => false,
                            'c' => false,
                            'w' => false,
                            'e' => false,
                            'd' => true,
                        ),
                    ),
                    '*' => array(
                        'create' => array(
                            'r' => false,
                            'c' => true,
                            'w' => false,
                            'e' => false,
                            'd' => true,
                        ),
                    ),
                ),
            )
        ),
        'admin' => array(
            'parent_group' => 'moderator',
            'actions' => array(
                'main' => array(
                    'main' => array(
                        'write' => array(
                            'r' => false,
                            'c' => false,
                            'w' => true,
                            'e' => false,
                            'd' => true,
                        ),
                    ),
                    
                ),
            )
        ),
        'superadmin' => array(
            'parent_group' => null,
            'actions' => array(
                '*' => array(// Все модули
                    '*' => array(// все контролеры модулей
                        '*' => array(//все екшены контроллеров
                            'r' => true, // только читать
                            'c' => true,
                            'w' => true,
                            'e' => true,
                            'd' => true,
                        ),
                    ),
                ),
            ),
        ),
    ),
);
?>
