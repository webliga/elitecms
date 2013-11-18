<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Auth
 *
 * @author Веталь
 */
class Auth extends Base
{
    //put your code here
    private $_nameUserSession = 'user';
        
    public function login($userDataArr)
    {
        $session = Core::app()->getSession();
        $session->setDataArr($this->_nameUserSession, $userDataArr);        
    }
    
    public function logout()
    {
        $session = Core::app()->getSession();
        $session->sessionDestroy();
    }
    
    public function getSessionDataArr()
    {
        $session = Core::app()->getSession();

        return $session->getDataArr($this->_nameUserSession);
    }
    
    public function checkUserSession()
    {
        $session = Core::app()->getSession();

        return $session->sessionIsset($this->_nameUserSession);
    }    
    
}

?>
