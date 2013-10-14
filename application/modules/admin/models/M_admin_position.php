<?php

/**
 * Главный клас для всех моделей
 * @author Веталь
 * @version 1.0
 * @updated 17-Вер-2013 20:15:13
 */
class M_admin_position extends Model
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

    function getAllUsersArr()
    {
        return $this->select('users');
    }

    function getAllpositions()
    {
        return $this->selectAllFromTable('positions');
    }

    function getModuleById($id)
    {
        $leftJoin = $this->_db->parse('LEFT JOIN  position_modules  ON modules.id = position_modules.module_id ');
        $leftJoin .= $this->_db->parse('LEFT JOIN  position  ON position_modules.position_id = position.id ');
        $fildsSelect = 'modules.*, position.id as id_position, position.name as name_position, position.name_system as name_system_position';

        return $this->selectAllByIdFromTable('modules', $id, $fildsSelect, $leftJoin);
    }

    function setModule($dataArr)
    {
        $this->insertTableRow('modules', $dataArr);
    }

    function deleteModuleById($id)
    {
        $this->deleteTableRowById('modules', $id);
    }

    function updateModuleById($id, $dataArr)
    {
        return $this->updateTableRowById('modules', $id, $dataArr);
    }

}

?>