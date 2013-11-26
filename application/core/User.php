<?php

class User extends Base
{

    private $_access = null;
    private $_userRoleAcces = null;
    private $_auth = null;

    function __construct()
    {
        parent::__construct();
        $this->init();
    }

    function __destruct()
    {
        parent::__destruct();
    }

    public function checkUserAccess($moduleAccessAction)
    {
        if ($this->_access->checkByUserGroupAccess($this->_userRoleAcces, $moduleAccessAction))
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

        if (is_null($this->_auth))
        {
            $class = Core::app()->getClassNameForCreate('auth');

            $this->_auth = new $class;
            
            $dataArr = $this->_auth->getSessionDataArr();
            
            if($dataArr != null)
            {
                $this->createUserVars($dataArr);
            }
        }
    }

    public function isAuth()
    {
        return $this->_auth->checkUserSession();
    }

    public function login($userDataArr)
    {
        $this->_auth->login($userDataArr);
        $this->createUserVars($userDataArr);
    }

    public function getUserSession()
    {
        $userDataArr = $this->_auth->getSessionDataArr();

        return $userDataArr;
    }

    private function createUserVars($userDataArr)
    {
        foreach ($userDataArr as $key => $value)
        {
            $this->$key = $value;
        }
    }

    public function logout()
    {
        $this->_auth->logout();
    }
    
    public function getField($fild)
    {
        if(isset($this->$fild))
        {
            return $this->$fild;
        }
        
        return null;
    }

}

?>
