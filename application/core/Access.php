<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Access
 *
 * @author Веталь
 */
class Access
{
    public function __construct()
    {
        
    }

    public function checkAccess($role = null)
    {
        if(!is_null($role) && is_array($role))
        {
            if($role['access']['r'])
            {
                return true;
            }
        }
        return false;
    }
}

?>
