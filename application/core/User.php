<?php

class User extends Base
{

    public $_test = null;
    private $_access = null;
    private $_auth = null;

    function __construct()
    {
        parent::__construct();
        $this->init();
        
        Core::app()->getEvent()->startEvent('user_construct', array($this));
    }

    function __destruct()
    {
        parent::__destruct();
    }

    public function checkUserAccess($moduleAccessCurrent)
    {
        
        //$this->echoPre($moduleAccessCurrent, false, true);

        if ($this->_access->checkByUserGroupAccess($this->getField('user_group_access'), $moduleAccessCurrent))
        {
            return true;
        }

        return false;
    }

    private function init()
    {
        if (is_null($this->_auth))
        {
            $class = Core::app()->getClassNameForCreate('auth');

            $this->_auth = new $class;

            $dataArr = $this->_auth->getSessionDataArr();

            if ($dataArr != null)
            {
                $this->createUserVars($dataArr);
            }
        }

        if (is_null($this->_access))
        {
            $accessClass = Core::app()->getClassNameForCreate('access');

            $this->_access = new $accessClass;
        }
    }

    public function isAuth()
    {
        return $this->_auth->checkUserSession();
    }

    public function login($userDataArr)
    {
        // Если пользователь не имеет группы, то ставим дефолтные права доступа
        if (!isset($userDataArr['user_group_access']))
        {
            $userDataArr['group_name'] = $this->getField('group_name');
            $userDataArr['user_group_access'] = $this->getField('user_group_access') ;
        }

        $this->_auth->login($userDataArr);
        $this->createUserVars($userDataArr);
    }

    public function logout()
    {
        $this->_auth->logout();
    }

    public function getUserSession()
    {
        $userDataArr = $this->_auth->getSessionDataArr();

        return $userDataArr;
    }

    public function createUserVars($userDataArr)
    {
        if (count($userDataArr) > 0)
        {
            foreach ($userDataArr as $key => $value)
            {
                $this->$key = $value;
            }
        }
    }

    public function getField($fild)
    {
        if (isset($this->$fild))
        {
            return $this->$fild;
        }

        return null;
    }

}

?>
