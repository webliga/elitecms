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

    function getAllTasks($limit = null)
    {
        $filds = 'crm_tasks.*, 
            crm_statuses.name as crm_statuses_name, 
            crm_statuses. description as crm_statuses_description, 
            crm_statuses.is_complete as crm_statuses_is_complete ';

        if (!$this->isEmpty($limit))
        {
            $join = $this->_db->parse('LEFT JOIN crm_statuses ON crm_tasks.id_status = crm_statuses.id ORDER BY date_create ASC LIMIT ?i', $limit);
        }
        else
        {
            $join = $this->_db->parse('LEFT JOIN crm_statuses ON crm_tasks.id_status = crm_statuses.id ORDER BY date_create ASC');
        }

        $data = $this->selectAllFromTable('crm_tasks', $filds, $join);

        return $data;
    }


    function getTaskById($id)
    {
        $sql = $this->_db->parse("
            SELECT crm_tasks.*,
                crm_statuses.name as crm_statuses_name, 
                crm_statuses. description as crm_statuses_description, 
                crm_statuses.is_complete as crm_statuses_is_complete 
            FROM crm_tasks 
            LEFT JOIN crm_statuses ON crm_statuses.id = crm_tasks.id_status
            WHERE crm_tasks.id = ?i 
            
", $id);

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