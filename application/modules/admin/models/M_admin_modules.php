<?php

/**
 * Главный клас для всех моделей
 * @author Веталь
 * @version 1.0
 * @updated 17-Вер-2013 20:15:13
 */
class M_admin_modules extends Model
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

    function getAllModules($name_system = null)
    {
        if ($name_system == NULL)
        {
            $leftJoin = $this->_db->parse('LEFT JOIN  position_modules  ON modules.id = position_modules.id_module ');
            $leftJoin .= $this->_db->parse('LEFT JOIN  positions  ON position_modules.id_position = positions.id ');
            $fildsSelect = 'modules.*, positions.id as id_position, positions.name as name_position, positions.name_system as name_system_position';
        }
        else
        {
            $leftJoin = $this->_db->parse(' WHERE name_system LIKE ?s ', $name_system );
            $fildsSelect = 'modules.id, modules.name';
            
        }
        return $this->selectAllFromTable('modules', $fildsSelect, $leftJoin);
    }

    function getModuleById($id)
    {
        $leftJoin = $this->_db->parse('LEFT JOIN  position_modules  ON modules.id = position_modules.id_module ');
        $leftJoin .= $this->_db->parse('LEFT JOIN  positions  ON position_modules.id_position = positions.id ');
        $fildsSelect = 'modules.*, positions.id as id_position, positions.name as name_position, positions.name_system as name_system_position';

        return $this->selectAllByIdFromTable('modules', $id, $fildsSelect, $leftJoin);
    }

    function setModule($dataArr)
    {
        $id_position = $dataArr['id_position'];
        $name_system = $dataArr['name_system'];
        unset($dataArr['id_position']);

        $data = $this->insertTableRow('modules', $dataArr);
        $id_module = $data['last_insert_id()'];

        $dataArr = null;
        $dataArr['id_position'] = $id_position;
        $dataArr['id_module'] = $id_module;
        
        $this->insertTableRow('position_modules', $dataArr);
        unset($dataArr['id_position']);

        $this->insertTableRow($name_system, $dataArr);        
        
    }

    function deleteModuleById($id)
    {
        $this->deleteTableRowById('modules', $id);
    }

    function updateModuleById($id, $dataArr)
    {

        $sql = $this->_db->parse("UPDATE position_modules SET id_position = ?i WHERE id_module = ?i", $dataArr['id_position'], $id);

        $this->_db->query($sql);

        unset($dataArr['id_position']);

        $this->updateTableRowById('modules', $id, $dataArr);
    }

}

?>