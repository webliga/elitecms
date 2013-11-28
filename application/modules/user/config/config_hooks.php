<?php

$config = array(
    'user_construct' => array(// имя события
        array(
            'title' => '',
            'description' => '',
            'module' => 'user',
            'controller' => 'groups',
            'action' => 'hookUpdateUserGroupAccess',
        ),
    ),
    'route_select_system_config' => array(// имя события
        array(
            'title' => '',
            'description' => '',
            'module' => 'user',
            'controller' => 'groups',
            'action' => 'hookModuleGroupAccess',
        ),
    ), 
    'news_select_menuitems' => array(// имя события
        array(
            'title' => '',
            'description' => '',
            'module' => 'user',
            'controller' => 'groups',
            'action' => 'hookMenuitemsGroupAccess',
        ),
    ),
    'menu_create_menuitem' => array(// имя события
        array(
            'title' => '',
            'description' => '',
            'module' => 'user',
            'controller' => 'groups',
            'action' => 'hookMenuitemsCreateGroupAccess',
        ),
    ),    
);
?>