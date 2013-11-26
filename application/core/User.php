<?php

class User extends Base
{

    private $_access = null;
    private $_auth = null;

    function __construct()
    {
        parent::__construct();
        $this->init();
        $this->setUpdateUserGroupAccess();
    }

    function __destruct()
    {
        parent::__destruct();
    }

    public function checkUserAccess($moduleAccessCurrent)
    {
        //$this->echoPre($this->getUserSession());
        //$this->echoPre($moduleAccessCurrent, false, true);

        if ($this->_access->checkByUserGroupAccess($this->getField('user_group_access'), $moduleAccessCurrent))
        {
            return true;
        }

        return false;
    }

    private function setUpdateUserGroupAccess()
    {
        // Если пользователь не авторизирован, то ставим группу ту что по умолчанию в файле 
        if (!$this->isAuth())
        {
            
            // Нужно сделать настройку этой группы из админки
            // что б контроллировать неавторизированных пользователей
            
            
            $default_groups = Core::app()->getConfig()->getConfigItem('default_groups');
            $default_role = Core::app()->getConfig()->getConfigItem('default_role');
            $default_group_role[] = $default_groups[$default_role['user_group']];

            $this->user_group_access = $default_group_role;
        }
        else
        {
            //тут нужно придумать реализацию обновления прав доступа
            
            
            //$this->echoPre($this->id, false, true);
        }
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
            $userDataArr['user_group_access'] = $this->user_group_access;
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

    private function createUserVars($userDataArr)
    {
        foreach ($userDataArr as $key => $value)
        {
            $this->$key = $value;
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
