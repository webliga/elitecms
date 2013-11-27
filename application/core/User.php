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
        $user = array();
        
        $userGroupModel = $this->loadModel('groups', 'user', true);

        $test = 'tra ta ta <br>';
        $test2 = 2;
        
        Core::app()->getEvent()->startEvent('before_start', array(&$test, &$test2, &$this));
        
        //$this->echoPre($test);
        //$this->echoPre($test2);  
        //$this->echoPre($this->_test);        
        // Если пользователь не авторизирован, то ставим группу ту что по умолчанию 
        // в настройках БД для неавторизированных. Если такой нету, то ту что в файле 
        if (!$this->isAuth())
        {
            $user = $this->getDefaultGroup($userGroupModel);

            //$this->echoPre($user, false, true);
            
            $this->createUserVars($user);
        }
        else
        {
            $userAuthModel = $this->loadModel('auth', 'user', true);
            $id_user = $this->getField('id');
            $user = $userAuthModel->getUserById($id_user);

            $id_group = $user['id_group'];

            if ($id_group != null && $id_group > 0)
            {
                $user_group = $userGroupModel->getGroupById($id_group);
                $user_group_access = $userGroupModel->getGroupAccess($id_group);
                $user['group_name'] = $user_group['name'];  
                $user['user_group_access'] = $user_group_access;
            }
            else
            {
                $userDef = $this->getDefaultGroup($userGroupModel);
                $user['id_group'] = $userDef['id_group'];
                $user['group_name'] = $userDef['group_name'];  
                $user['user_group_access'] = $userDef['user_group_access'];
            }
            $this->login($user);//Обновляем данные в сессиии
        }
    }

    private function getDefaultGroup($userGroupModel)
    {
        $user = array();

        $setting = Core::app()->getConfig()->getConfigItem('settings');
        $id_group_default_unauthorized = $setting['group_default_unauthorized'];

        if ($userGroupModel != null && !$this->isEmpty($id_group_default_unauthorized) && $id_group_default_unauthorized > 0)
        {
            $user_group = $userGroupModel->getGroupById($id_group_default_unauthorized);            
            $user_group_access = $userGroupModel->getGroupAccess($id_group_default_unauthorized);

            $user['id_group'] = $id_group_default_unauthorized;
            $user['group_name'] = $user_group['name'];            
            $user['user_group_access'] = $user_group_access;
        }
        else
        {
            $default_groups = Core::app()->getConfig()->getConfigItem('default_groups');
            $default_role = Core::app()->getConfig()->getConfigItem('default_role');
            $default_group_role[] = $default_groups[$default_role['user_group']];


            $user['id_group'] = 0;
            $user['group_name'] = $default_role['user_group'];  
            $user['user_group_access'] = $default_group_role;
        }

        return $user;
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

    private function createUserVars($userDataArr)
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
