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
class Access extends Base
{

    public function __construct()
    {
        
    }

    public function checkByUserGroupAccess($user_group_access, $moduleAccessCurrent)
    {
        $checked = false;

        for ($i = 0; $i < count($user_group_access); $i++)
        {
            $checked = $this->searchModuleControllerAction($user_group_access[$i], $moduleAccessCurrent);
            if ($checked)
            {
                break;
            }
        }


        return $checked;
    }

    private function searchModuleControllerAction($group_access, $moduleAccessCurrent)
    {
        if ($group_access['module'] == '*' || $group_access['module'] == $moduleAccessCurrent['module'])
        {
            if ($group_access['controller'] == '*' || $group_access['controller'] == $moduleAccessCurrent['controller'])
            {
                if ($group_access['action'] == '*' || $group_access['action'] == $moduleAccessCurrent['action'])
                {



                    if ($group_access['access_type'] == '*' ||
                            (
                            (
                            $group_access['access_type'] == $moduleAccessCurrent['access']['access_type']
                            ) &&
                            $group_access['access_type_value'] == 1
                            )
                    )
                    {

                        return true;
                    }
                }
            }
        }

        return false;
    }

}

?>
