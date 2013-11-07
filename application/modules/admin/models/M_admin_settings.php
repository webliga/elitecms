<?php

/**
 * Главный клас для всех моделей
 * @author Веталь
 * @version 1.0
 * @updated 17-Вер-2013 20:15:13
 */
class M_admin_settings extends Model
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

    function getAllSettings()
    {
        $result = null;
        $arr = $this->selectAllFromTable('settings');  
        $result['langs_all'] = $this->selectAllFromTable('langs'); 
        
        
        for ($i = 0; $i < count($arr); $i++)
        {
            $result[$arr[$i]['name']] = $arr[$i]['value'];
        }

        return $result;
    }

    function getModuleById($id)
    {
        $leftJoin = $this->_db->parse('LEFT JOIN  position_modules  ON modules.id = position_modules.id_module ');
        $leftJoin .= $this->_db->parse('LEFT JOIN  positions  ON position_modules.id_position = positions.id ');
        $fildsSelect = 'modules.*, positions.id as id_position, positions.name as name_position, positions.name_system as name_system_position';

        return $this->selectAllByIdFromTable('modules', $id, $fildsSelect, $leftJoin);
    }

    function setSettings($dataArr)
    {
        $this->insertTableRow('settings', $dataArr);
    }

    function deleteModuleById($id)
    {
        $this->deleteTableRowById('modules', $id);


        $condition = $this->_db->parse('id_module = ?i', $id);
        $this->deleteTableRowByCondition('position_modules', $condition);
    }

    function updateSettings($dataArr)
    {
        // нужно оптимизировать
        // как минимум обновить только измененные данные (при старте системы мы получаем все данные)
        foreach ($dataArr as $key => $value)
        {
            $data['value'] = $value;
            $this->updateTableRowByCondition('settings', 'name', $key, $data);
        }
    }

}

?>