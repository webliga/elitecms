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

    function getAllTasks()
    {
        $leftJoin = $this->_db->parse('LEFT JOIN  category_items  ON 
                                       crm_tasks.id_category_items = category_items.id'
                                      );

        $fildsSelect = 'crm_tasks.*, 
                        category_items.id as id_category_items, 
                        category_items.name as name_category_items';


        return $this->selectAllFromTable('crm_tasks', $fildsSelect, $leftJoin);
    }


    function getTaskById($id)
    {
        $sql = $this->_db->parse("
            SELECT *
            FROM crm_tasks 
            WHERE id = ?i", $id);

        $data = $this->_db->getRow($sql);

        return $data;
    }

    function deleteTaskById($id)
    {
        $this->deleteTableRowById('crm_tasks', $id);
        
        $this->deleteAllTasksByParentId($id);
    }    

    function deleteAllTasksByParentId($id)
    {
        $condition = $this->_db->parse('?n.?n = ?i','crm_tasks','id_parent' ,$id);
         
        $result = $this->deleteTableRowByCondition('crm_tasks', $condition);
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