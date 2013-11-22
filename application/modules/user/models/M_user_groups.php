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

    public function setGroup($dataArr)
    {
        $this->insertTableRow('users_groups', $dataArr);
    }

    public function geGroupById($id)
    {
        $data = $this->selectAllByIdFromTable('users_groups', $id);

        return $data;
    }


    public function updateGroupById($id, $dataArr)
    {
        $this->updateTableRowById('users_groups', $id, $dataArr);
    }

    public function deleteGroup($id)
    {
        $this->deleteTableRowById('users_groups', $id);
    }
}

?>