<?php

/**
 * Главный клас для всех моделей
 * @author Веталь
 * @version 1.0
 * @updated 17-Вер-2013 20:15:13
 */
class M_user_groups extends Model
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

    public function setGroup($dataArr)
    {
        return $this->insertTableRow('users_groups', $dataArr);
    }
    
    public function setGroupAccess($dataArr)
    {
        $this->insertTableRow('users_groups_access', $dataArr);
    }
    
    function getAllGroups($limit = null)
    {
        $data = $this->selectAllFromTable('users_groups', null, null);

        return $data;
    }
    
    public function getGroupById($id)
    {
        $data = $this->selectAllByIdFromTable('users_groups', $id);

        return $data;
    }
    
    function getGroupAccess($id_group)
    {
        $id_group = (int)$id_group;
        
        $join = $this->_db->parse('
            LEFT JOIN modules ON modules.id = users_groups_access.id_module 
            WHERE ?n = ?i
            ','id_group' ,$id_group);
        
        $fildsSelect = 'users_groups_access.*, modules.name_system as module';
        
        $data = $this->selectAllFromTable('users_groups_access', $fildsSelect, $join);

        return $data;
    }    

    public function updateGroupById($id, $dataArr)
    {
        $this->updateTableRowById('users_groups', $id, $dataArr);
    }

    public function updateGroupAccessById($id, $dataArr)
    {
        $this->updateTableRowById('users_groups_access', $id, $dataArr);
    }
    
    public function deleteGroup($id)
    {
        $this->deleteTableRowById('users_groups', $id);
    }
        
    public function deleteGroupAccess($id)
    {
        $condition = $this->_db->parse('?n = ?i', 'id_group', $id) ;
        
        $this->deleteTableRowByCondition('users_groups_access', $condition);
    }
}

?>