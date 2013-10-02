<?php

/**
 * Главный клас для всех моделей
 * @author Веталь
 * @version 1.0
 * @updated 17-Вер-2013 20:15:13
 */
class M_menu_main extends Model
{

    public $_name_model;

    function __construct()
    {
        parent::__construct();

        $this->_name_model = $this->getClassName();
    }

    function __destruct()
    {
        
    }

    function getMenuById($id)
    {
        $arrMenu = array(
            0 => array(
                'menu_items' => array(
                    0 => array(
                        'id' => 1,
                        'name' => 'Каталог',
                        'link' => '/catalog/main'
                    ),
                    1 => array(
                        'id' => 2,
                        'name' => 'Новости',
                        'link' => '/news/main'
                    ),
                    2 => array(
                        'id' => 3,
                        'name' => 'Блог',
                        'link' => '/blog/main'
                    ),
                    3 => array(
                        'id' => 4,
                        'name' => 'Корзина',
                        'link' => '/cart/main'
                    ),
                    4 => array(
                        'id' => 5,
                        'name' => 'О нас',
                        'link' => '/pages/main'
                    ),
                ),
            ),
            1 => array(
                'menu_items' => array(
                    0 => array(
                        'id' => 6,
                        'name' => 'Каталог2',
                        'link' => '/catalog/main'
                    ),
                    1 => array(
                        'id' => 7,
                        'name' => 'Новости2',
                        'link' => '/news/main'
                    ),
                    2 => array(
                        'id' => 8,
                        'name' => 'Блог2',
                        'link' => '/blog/main'
                    ),
                    3 => array(
                        'id' => 9,
                        'name' => 'Корзина2',
                        'link' => '/cart/main'
                    ),
                    4 => array(
                        'id' => 10,
                        'name' => 'О нас2',
                        'link' => '/pages/main'
                    ),
                ),
            ),
            2 => array(
                'menu_items' => array(
                    0 => array(
                        'id' => 6,
                        'name' => 'Каталог3',
                        'link' => '/catalog/main'
                    ),
                    1 => array(
                        'id' => 7,
                        'name' => 'Новости3',
                        'link' => '/news/main'
                    ),
                    2 => array(
                        'id' => 8,
                        'name' => 'Блог3',
                        'link' => '/blog/main'
                    ),
                    3 => array(
                        'id' => 9,
                        'name' => 'Корзина3',
                        'link' => '/cart/main'
                    ),
                    4 => array(
                        'id' => 10,
                        'name' => 'О нас3',
                        'link' => '/pages/main'
                    ),
                ),
            ),
        );
        
        for($i = 0;$i < count($arrMenu);$i++)
        {
            if($i == $id)
            {
                return $arrMenu[$i];
            }
        }
        
        
        return  array();
    }

}

?>