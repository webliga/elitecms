<?php

/**
 * Главный клас для всех моделей
 * @author Веталь
 * @version 1.0
 * @updated 17-Вер-2013 20:15:13
 */
class M_crm_tasks extends Model
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

    function getAllCrmItems()
    {
        $leftJoin = $this->_db->parse('LEFT JOIN  category_items  ON 
                                       Crm_items.id_category_items = category_items.id'
                                      );

        $fildsSelect = 'Crm_items.*, 
                        category_items.id as id_category_items, 
                        category_items.name as name_category_items';


        return $this->selectAllFromTable('Crm_items', $fildsSelect, $leftJoin);
    }

    function getCrmTaskById($id)
    {
        return $this->selectAllByIdFromTable('crm_tasks', $id);
    }

    function deleteCrmItemById($id)
    {
        $this->deleteTableRowById('Crm_items', $id);
    }    

    function deleteAllCrmItemsByModuleId($id)
    {
        $condition = $this->_db->parse('?n.?n = ?i','Crm_items','id_module' ,$id);
         
        $result = $this->deleteTableRowByCondition('Crm_items', $condition);
    }        
    
    function updateTaskById($id, $dataArr)
    {
        return $this->updateTableRowById('crm_tasks', $id, $dataArr);
    } 
         
    function setTaskItem($dataArr)
    {
        $this->insertTableRow('crm_tasks', $dataArr);
    }     
    
}

?>