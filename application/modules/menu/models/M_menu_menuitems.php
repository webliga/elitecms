<?php

/**
 * Главный клас для всех моделей
 * @author Веталь
 * @version 1.0
 * @updated 17-Вер-2013 20:15:13
 */
class M_menu_menuitems extends Model
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

    function getAllMenuItems()
    {
        $leftJoin = $this->_db->parse('LEFT JOIN  modules  ON menu_items.id_module = modules.id');

        $fildsSelect = 'menu_items.*, modules.id as id_module, modules.name as name_module, modules.name_system as name_system_module';


        return $this->selectAllFromTable('menu_items', $fildsSelect, $leftJoin);
    }

    
    function getMenuItemById($id)
    {

        $leftJoin = $this->_db->parse('LEFT JOIN  modules  ON menu_items.id_module = modules.id');

        $fildsSelect = 'menu_items.*, modules.id as id_module, modules.name as name_module, modules.name_system as name_system';


        return $this->selectAllByIdFromTable('menu_items', $id, $fildsSelect, $leftJoin);
    }

    function deleteMenuItemById($id)
    {
        $this->deleteTableRowById('menu_items', $id);
    }    

    function deleteAllMenuItemsByModuleId($id)
    {
        $condition = $this->_db->parse('?n.?n = ?i','menu_items','id_module' ,$id);
         
        $result = $this->deleteTableRowByCondition('menu_items', $condition);
    }        
    
    function updateMenuitemById($id, $dataArr)
    {
        return $this->updateTableRowById('menu_items', $id, $dataArr);
    } 
         
    function setMenuItem($dataArr)
    {
        $id = $this->insertTableRow('menu_items', $dataArr);

        return (isset($id['last_insert_id()'])) ? $id['last_insert_id()'] : 0 ;
    }     
    
}

?>