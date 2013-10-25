<?php

/**
 * Главный клас для всех моделей
 * @author Веталь
 * @version 1.0
 * @updated 17-Вер-2013 20:15:13
 */
class M_category_categoryitems extends Model
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

    function getAllCategoryItems()
    {
        $leftJoin = $this->_db->parse('LEFT JOIN  modules  ON category_items.id_module = modules.id');

        $fildsSelect = 'category_items.*, modules.id as id_module, modules.name as name_module, modules.name_system as name_system_module';


        return $this->selectAllFromTable('category_items', $fildsSelect, $leftJoin);
    }

    function getCategoryItemById($id)
    {

        $leftJoin = $this->_db->parse('LEFT JOIN  modules  ON category_items.id_module = modules.id');

        $fildsSelect = 'category_items.*, modules.id as id_module, modules.name as name_module, modules.name_system as name_system';


        return $this->selectAllByIdFromTable('category_items', $id, $fildsSelect, $leftJoin);
    }

    function deleteCategoryItemById($id)
    {
        $this->deleteTableRowById('category_items', $id);
    }    

    function deleteAllCategoryItemsByModuleId($id)
    {
        $condition = $this->_db->parse('?n.?n = ?i','category_items','id_module' ,$id);
         
        $result = $this->deleteTableRowByCondition('category_items', $condition);
    }        
    
    function updateCategoryitemById($id, $dataArr)
    {
        return $this->updateTableRowById('category_items', $id, $dataArr);
    } 
         
    function setCategoryItem($dataArr)
    {
        $this->insertTableRow('category_items', $dataArr);
    }     
    
}

?>