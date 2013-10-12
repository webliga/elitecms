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
        $is_active = 1;
        
        $query = 'SELECT *
            FROM menu_items 
            WHERE id_module = ' . $id . 
                ' AND is_active = ' . $is_active;

        $data = $this->_db->getAll($query);
          
        return  $data;
    }

}

?>