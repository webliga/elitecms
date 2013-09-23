<?php

class User extends Base
{

    private $_access;

    function __construct()
    {
        parent::__construct();
        $this->init();
    }

    function __destruct()
    {
        parent::__destruct();
    }

    public function checkUserAccess()
    {
        if ($this->_access->checkAccess())
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
    }

}

?>
