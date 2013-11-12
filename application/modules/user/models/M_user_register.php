<?php

/**
 * Главный клас для всех моделей
 * @author Веталь
 * @version 1.0
 * @updated 17-Вер-2013 20:15:13
 */
class M_user_register extends Model
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
    
    function getUserById($id)
    {
        $sql = $this->_db->parse("
            SELECT *
            FROM users 
            WHERE users.id = ?i 
            
", $id);

        $data = $this->_db->getRow($sql);

        return $data;
    }
    
    function deleteUserById($id)
    {
        $this->deleteTableRowById('users', $id);

    }          
    
    function updateUserById($id, $dataArr)
    {
        return $this->updateTableRowById('users', $id, $dataArr);
    } 
         
    function setUser($dataArr)
    {
        $this->insertTableRow('users', $dataArr);
    }     
    
}

?>