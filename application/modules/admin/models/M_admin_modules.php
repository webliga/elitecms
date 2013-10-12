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
    
    function getAllModules()
    {
        return $this->selectAllFromTable('modules');
    }
     
    function getModuleById($id)
    {
        return $this->selectAllByIdFromTable('modules', $id);
    }   
     
    function updateModuleById($id, $dataArr)
    {
        return $this->updateTableRowById('modules', $id, $dataArr);
    }       
    
}

?>