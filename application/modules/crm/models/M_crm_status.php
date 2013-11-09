<?php

/**
 * Главный клас для всех моделей
 * @author Веталь
 * @version 1.0
 * @updated 17-Вер-2013 20:15:13
 */
class M_crm_status extends Model
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

    function getAllStatuses()
    {
        return $this->selectAllFromTable('crm_statuses');
    }


    function getStatusById($id)
    {
        $sql = $this->_db->parse("
            SELECT *
            FROM crm_statuses 
            WHERE id = ?i", $id);

        $data = $this->_db->getRow($sql);

        return $data;
    }

    function deleteStatusById($id)
    {
        $this->deleteTableRowById('crm_statuses', $id);
    }         
    
    function updateStatusById($id, $dataArr)
    {
        return $this->updateTableRowById('crm_statuses', $id, $dataArr);
    } 
         
    function setStatusItem($dataArr)
    {
        $this->insertTableRow('crm_statuses', $dataArr);
    }     
    
}

?>