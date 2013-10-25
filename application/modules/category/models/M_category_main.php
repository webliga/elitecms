<?php

/**
 * Главный клас для всех моделей
 * @author Веталь
 * @version 1.0
 * @updated 17-Вер-2013 20:15:13
 */
class M_category_main extends Model
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

    function getCategoryItemsByModuleId($id)
    {
        $is_active = 1;
        $join = $this->_db->parse('WHERE category_items.id_module = ?i AND category_items.is_active = ?i ORDER BY priority ASC', $id, $is_active);
        
        $data = $this->selectAllFromTable('category_items', null, $join);
        return $data;
    }

    function getCategorySettingsByModuleId($id)
    {
        $data = $this->selectAllByIdFromTable('category',$id , null, null, 'id_module');
        return $data;
    }
    
    function updateCtegorySettingsByModuleId($dataArr)
    {
        $id_module = $dataArr['id_module'];
        unset($dataArr['id_module']);// На всяк случай удаляем
        
        $result = $this->updateTableRowByCondition('category', 'id_module', $id_module, $dataArr);        
    }
    
    function deleteCategorySettingsByModuleId($id)
    {       
        $condition = $this->_db->parse('?n.?n = ?i','category','id_module' ,$id);
         
        $result = $this->deleteTableRowByCondition('category', $condition);        
    }    
}

?>