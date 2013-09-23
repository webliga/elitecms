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

    private function getParentAccess($group, $arr_actions)
    {
        $groups = Core::app()->getConfig()->getConfigItem('groups');

        $access_user_group = $groups[$group];

        if ($access_user_group['parent_group'] != null)
        {
            $arr_actions = $this->getParentAccess($access_user_group['parent_group'], $access_user_group['actions']);
        }
        //Core::app()->echoPre($arr_actions);

        foreach ($access_user_group['actions'] as $key_module => $value_module_arr)
        {
            foreach ($value_module_arr as $key_controller => $value_controller_arr)
            {

                foreach ($value_controller_arr as $key_action => $value_action_arr)
                {
                    $arr_actions[$key_module][$key_controller][$key_action] = $value_action_arr;
                }
            }
        }

        return $arr_actions;
    }

    public function checkAccess($userRoleAcces, $arrAccessAction)
    {
        $bool = false;

        // Получаем все группы пользователей
        $groups = Core::app()->getConfig()->getConfigItem('groups');
        //Параметры  группы пользователя
        $access_user_group = $groups[$userRoleAcces['user_group']];
        //Core::app()->echoPre($access_user_group);
        // Если есть родительская группа, копируем ее разрешения/доступы
        if ($access_user_group['parent_group'] != null)
        {// Получаем масив настроек родителей, что б унаследовать доступы
            $arr_actions = $this->getParentAccess($access_user_group['parent_group'], $access_user_group['actions']);

            // наследуем от родителя доступы (если екшен совпадает с родителем, то родительский доступ тогда не наследуем)
            foreach ($arr_actions as $key_module => $value_module_arr)
            {
                foreach ($value_module_arr as $key_controller => $value_controller_arr)
                {
                    foreach ($value_controller_arr as $key_action => $value_action_arr)
                    {// Если екшена у даной группы не существует то унаследуемся от родителя, иначе не допускаем перезапись. Настройки остаются, внезависимости как настроен родитель
                        if (!isset($access_user_group['actions'][$key_module][$key_controller][$key_action]))
                        {
                            $access_user_group['actions'][$key_module][$key_controller][$key_action] = $value_action_arr;
                        }
                    }
                }
            }
        }

        Core::app()->echoPre($access_user_group);

        if (!is_null($userRoleAcces) && is_array($userRoleAcces))
        {
            //$groups = Core::app()->getConfig()->getConfigItem('groups');
            //$access_user_group = $groups[$userRoleAcces['user_group']];
            // Ищем именно наш екшн
            foreach ($access_user_group['actions'] as $key_module => $value_controllers_arr)
            {
                // Если это наш модуль
                if ($key_module == $arrAccessAction['module'] || $key_module == '*')
                {

                    foreach ($value_controllers_arr as $key_controller => $value_action_arr)
                    {
                        // Если это наш контроллер
                        if ($key_controller == $arrAccessAction['controller'] || $key_controller == '*')
                        {
                            foreach ($value_action_arr as $key_action => $action_role_arr)
                            {
                                // Если это наш екшн
                                if ($key_action == $arrAccessAction['action'] || $key_action == '*')
                                {

                                    if (
                                            (isset($arrAccessAction['access']['d']) && $arrAccessAction['access']['d'] && $value_action_arr[$key_action]['d']) ||
                                            (isset($arrAccessAction['access']['e']) && $arrAccessAction['access']['e'] && $value_action_arr[$key_action]['e']) ||
                                            (isset($arrAccessAction['access']['w']) && $arrAccessAction['access']['w'] && $value_action_arr[$key_action]['w']) ||
                                            (isset($arrAccessAction['access']['c']) && $arrAccessAction['access']['c'] && $value_action_arr[$key_action]['c']) ||
                                            (isset($arrAccessAction['access']['r']) && $arrAccessAction['access']['r'] && $value_action_arr[$key_action]['r']) 
                                            
                                    )
                                    {
                                       $bool = true;
                                    }
                                }
                            }
                        }
                    }
                }
                else
                {
                    Core::app()->echoPre('333');
                    Core::app()->echoPre($access_user_group['actions'][$key_module]);
                    Core::app()->echoPre($arrAccessAction['module']);
                }
            }
        }

        return $bool;
    }

}

?>
