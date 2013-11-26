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

    function getAllGroups($limit = null)
    {
        $data = $this->selectAllFromTable('users_groups', null, null);

        return $data;
    }

    function getGroupAccess($id_group)
    {
        $id_group = (int)$id_group;
        
        $join = $this->_db->parse('WHERE ?n = ?i','id_group' ,$id_group);
        
        $data = $this->selectAllFromTable('users_groups_access', null, $join);

        return $data;
    }    

    public function setGroup($dataArr)
    {
        return $this->insertTableRow('users_groups', $dataArr);
    }
    
    public function setGroupAccess($dataArr)
    {
        $this->insertTableRow('users_groups_access', $dataArr);
    }
    
    public function getGroupById($id)
    {
        $data = $this->selectAllByIdFromTable('users_groups', $id);

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