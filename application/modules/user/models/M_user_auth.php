<?php

/**
 * Главный клас для всех моделей
 * @author Веталь
 * @version 1.0
 * @updated 17-Вер-2013 20:15:13
 */
class M_user_auth extends Model
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

    public function searchUserByLogin($login)
    {
        $sql = $this->_db->parse('SELECT * FROM users WHERE ?n = ?s', 'login', $login);

        $data = $this->_db->getRow($sql);

        return $data;
    }    
    
}

?>