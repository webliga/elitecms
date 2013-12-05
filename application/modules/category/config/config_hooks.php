<?php

$config = array(
    'shop_before_product_create_empty' => array(// имя события
        array(
            'title' => '',
            'description' => '',
            'module' => 'category',
            'controller' => 'hooks',
            'action' => 'hook_get_all_category',
        ),
    ),
);
?>