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
class Session extends Base
{

    //put your code here

    private function sessionStart()
    {
                
        if (!isset($_SESSION))
        {
            session_start();
        }
    }

    public function sessionDestroy()
    {
        $this->sessionStart();
        session_unset();
        session_destroy();
    }
   
    public function getDataArr($sessionName)
    {
        $this->sessionStart();

        if(!isset($_SESSION[$sessionName]))
        {
            return null;
        }
        
        return $_SESSION[$sessionName];
    }
       
    public function setDataArr($sessionName, $dataArr)
    {
        $this->sessionStart();

        $_SESSION[$sessionName] = $dataArr;
    }
       
    public function sessionIsset($sessionName)
    {
        $this->sessionStart();

        if(isset($_SESSION[$sessionName]))
        {
            return true;
        }
        
        return false;
    }    
}

?>