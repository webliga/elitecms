<?php

/**
 * Главный клас для всех моделей
 * @author Веталь
 * @version 1.0
 * @updated 17-Вер-2013 20:15:13
 */
class M_crm_main extends Model
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

    function getTaskById($id)
    {
        $sql = $this->_db->parse("
            SELECT *
            FROM crm_tasks 
            WHERE id = ?i", $id);

        $data = $this->_db->getRow($sql);

        return $data;
    }

    function getAllTasks($limit = null)
    {
        $filds = 'crm_tasks.*, crm_statuses.name as crm_statuses_name, crm_statuses. description as crm_statuses_description, crm_statuses.is_complete as crm_statuses_is_complete ';

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

    function getCrmSettingsByModuleId($id)
    {
        $data = $this->selectAllByIdFromTable('crm', $id, null, null, 'id_module');
        return $data;
    }

    function updateCrmSettingsByModuleId($dataArr)
    {
        $id_module = $dataArr['id_module'];
        unset($dataArr['id_module']);

        $result = $this->updateTableRowByCondition('crm', 'id_module', $id_module, $dataArr);
    }

    function deleteCrmSettingsByModuleId($id)
    {
        $condition = $this->_db->parse('?n.?n = ?i', 'crm', 'id_module', $id);

        $result = $this->deleteTableRowByCondition('crm', $condition);
    }

}

?>