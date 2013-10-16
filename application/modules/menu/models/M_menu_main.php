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

    function getMenuItemsByModuleId($id)
    {
        $is_active = 1;
        $join = $this->_db->parse('WHERE menu_items.id_module = ?i AND menu_items.is_active = ?i', $id, $is_active);
        
        $data = $this->selectAllFromTable('menu_items', null, $join);
        return $data;
    }

    function getMenuSettingsByModuleId($id)
    {
        $data = $this->selectAllByIdFromTable('menu',$id , null, null, 'id_module');
        return $data;
    }
}

?>