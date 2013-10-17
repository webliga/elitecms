<?php

class User extends Base
{

    private $_access;
    private $_userRoleAcces;

    function __construct()
    {
        parent::__construct();
        $this->init();
    }

    function __destruct()
    {
        parent::__destruct();
    }

    public function checkUserAccess($arrAccessAction)
    {
        if ($this->_access->checkByUserGroupAccess($this->_userRoleAcces, $arrAccessAction))
        {
            return true;
        }

        return false;
    }

    private function init()
    {
        if (is_null($this->_access))
        {
            $accessClass = Core::app()->getClassNameForCreate('access');

            $this->_access = new $accessClass;
        }
        
        $this->_userRoleAcces = Core::app()->getConfig()->getConfigItem('default_role');
    }

}

?>
