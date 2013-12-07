<?php

/**
 * Главный клас модуля, все запросы по умолчанию отправляются сюда
 * @author Веталь
 * @version 1.0
 * @updated 17-Вер-2013 20:15:13
 */
class C_user_groups extends Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function __destruct()
    {
        
    }

    /**
     * index вызывается только в одном случаяе
     * 1. через url ($dataArr == null)
     */
    // Загружаем этот метод только из строки браузера
    // $dataArr - get параметры, передаваемые в строке браузера
    public function index($dataArr = null)
    {

        $this->loadModel('groups');
        $this->M_user_groups->getAllGroups();


        $dataArr = $this->M_user_groups->getAllGroups();


        for ($i = 0; $i < count($dataArr); $i++)
        {
            // unset($dataArr[$i]['preview']);
        }

        $dataArr['link_edite'] = 'groups/edite/';
        $dataArr['link_delete'] = 'groups/delete/';
        //$this->echoPre($dataArr['link_edite']);
        $content = Core::app()->getTemplate()->getWidget('data_table', $dataArr);


        Core::app()->getTemplate()->setVar('title_page', 'Список групп');

        Core::app()->getTemplate()->setVar('content', $content);
    }

    function buildTree($array_items)
    {

        if (is_array($array_items))
        {
            $items_count = count($array_items);
            for ($i = 0; $i < $items_count; $i++)
            {
                $item = $array_items[$i];

                //$this->echoPre($item['id']);
                //$this->echoPre($item);

                if ($item['id_parent'] == 0)
                { //верхний уровень
                    $children = $this->getChildNode($array_items, $item['id']);

                    if (isset($item['crm_statuses_is_complete']) && $item['crm_statuses_is_complete'])
                    {
                        $item['percent'] = 100;
                    }
                    else
                    {
                        $item['percent'] = $this->getPercentComplete($children);
                    }


                    $item['children'] = $children;
                    $result[] = $item;

                    //$this->echoPre($children);
                    //$this->echoPre($item);
                }
            }
        }
        return (isset($result)) ? $result : false;
    }

    function getChildNode($array, $id)
    {
        $count = count($array);
        for ($i = 0; $i < $count; $i++)
        { // перебор массива
            $item = $array[$i];


            if ($item['id_parent'] == $id)
            { // 2 уровень найден
                $children = $this->getChildNode($array, $item['id']);

                // Если статус говорит что задание завершено (проверяется, завершено, закрыто, одобренно и т.д.)
                if (isset($item['crm_statuses_is_complete']) && $item['crm_statuses_is_complete'])
                {
                    $item['percent'] = 100;
                }
                else
                {
                    $item['percent'] = $this->getPercentComplete($children);
                }

                $item['children'] = $children;
                $child_array[] = $item; // добавить 2 уровень
            }
        }
        if (isset($child_array))
        {
            return $child_array;
        }
        else
        {
            return false;
        }
    }

    private function getPercentComplete($children)
    {
        $percent = 0;

        if (isset($children) && is_array($children))
        {
            $count = count($children);
            $part = floor(100 / $count); // 100% делим на к-ство потомков
            $all_child_complete = true;

            for ($i = 0; $i < $count; $i++)
            {
                if ($children[$i]['percent'] < 100)// если потомок завершен, то добавляем его % к основному %
                {
                    $all_child_complete = false;
                }

                $percent += floor($part * ($children[$i]['percent'] / 100));
            }

            // Если все детки имеют статус завершено. Например 100 / 3 дает 33, что при сумме 99, а не 100
            // Тогда прописываем 100 вручную
            if ($all_child_complete)
            {
                $percent = 100;
            }
        }

        return $percent;
    }

    public function createTreeView($array_items, $level = 1, $classArr)
    {
        $display = '';
        if ($level > 1)
        {
            $display = 'displaynone';
        }

        $result = '';

        $result .= '<ul  class="' . $classArr['menu_ul'] . ' ' . $classArr['menu_ul_level'] . '-' . $level . ' ' . $display . '">';

        if (is_array($array_items))
        {
            $items_count = count($array_items);

            for ($i = 0; $i < $items_count; $i++)
            {
                $item = $array_items[$i];

                $menu_span = $classArr['menu_span'];

                if (!isset($item['crm_statuses_name']))
                {
                    $item['crm_statuses_name'] = 'Открытая';
                }

                if (!isset($item['title']))
                {
                    $item['title'] = '';
                }

                if (!isset($item['class_li']))
                {
                    $item['class_li'] = '';
                }

                if ($item['crm_statuses_is_complete'])// если потомок завершен, то добавляем его % к основному %
                {
                    $menu_span = 'task_menu_a_complete';
                }

                $count = 0;
                $arrow = '';
                if (is_array($item['children']))
                { //верхний уровень
                    $count = count($item['children']);
                }

                if ($count != 0)
                {
                    $arrow =
                            '<img class="img_arrow" src=\'/img/red_arrow.png\' width=\'20\' />' .
                            '(' . $count . ')  ';
                }

                $result .= '<li class="' . $classArr['menu_li'] . ' ' . $item['class_li'] . '">';
                $result .=
                        $arrow .
                        '<a  class="' . $classArr['menu_a'] . '"  href="' . Core::app()->getHtml()->createUrl('crm/tasks/?id=' . $item['id']) . '" title="' . $item['title'] . '">' .
                        $item['name'] .
                        ' (' .
                        $item['percent'] . ' %) ' .
                        '<span class="' . $menu_span . '">' .
                        ' ( ' .
                        $item['crm_statuses_name'] . ' )' .
                        '</span>' .
                        '</a>';

                if (is_array($item['children']))
                { //верхний уровень
                    $level++;
                    $result .= $this->createTreeView($item['children'], $level, $classArr);
                    $level--;
                }

                $result .= '</li>';
            }
        }

        $result .= '</ul>';
        return (isset($result)) ? $result : false;
    }

    // Загружаем этот метод только для вывода в позиции модуля
    public function showDataByPosition($dataArr = null)
    {
        // этот модуль вызывается только через url
    }

    public function create()
    {
        $user = Core::app()->getUser();

        //$this->echoPre($user->getField('id'));
        //Core::app()->echoPre($user->getUserSession());

        $post = Core::app()->getRequest()->getPost();

        $this->loadModel('groups');

        if (!$this->isEmpty($post))
        {
            $dataArr['name'] = $post['name'];
            $dataArr['description'] = $post['description'];

            $id = $this->M_user_groups->setGroup($dataArr);

            for ($i = 0; $i < count($post['access']); $i++)
            {
                for ($y = 0; $y < count($post['access'][$i]); $y++)
                {
                    $post['access'][$i][$y]['id_group'] = $id['last_insert_id()'];
                }
            }

            $this->accessupdate($post);


            $url = Core::app()->getHtml()->createUrl('admin/groups');
            Core::app()->getRequest()->redirect($url, true, 302);
        }
        else
        {
            $dataArr = array();
            $dataArr['id'] = 0;
            $dataArr['access'] = $this->access(0);

            $dataArr['form_action'] = 'admin/groups/create/';
            $dataArr['path'] = '';
            $dataArr['name_module'] = 'user'; // папка где брать файл
            $dataArr['file_content_view'] = 'mod_group_create.php';
            $dataArr['return'] = true;

            $dataArr['content'] = Core::app()->getTemplate()->moduleContentView($dataArr);
            $content = Core::app()->getTemplate()->getWidget('form', $dataArr);

            Core::app()->getTemplate()->setVar('title_page', 'Создание группы');
            Core::app()->getTemplate()->setVar('content', $content);
        }
    }

    public function write()
    {
        
    }

    public function edite($params = null)
    {
        $id = 0;
        if ($params != null && is_array($params))
        {
            $id = $params['id'];
        }
        else
        {
            $get = Core::app()->getRequest()->getGet();
            $id = $get['id'];
        }


        $this->loadModel('groups');
        $dataArr = $this->M_user_groups->getGroupById($id);
        $dataArr['access'] = $this->access($id);

        $dataArr['form_action'] = 'admin/groups/update/';
        $dataArr['path'] = '';
        $dataArr['name_module'] = 'user';
        $dataArr['file_content_view'] = 'mod_group_create.php';
        $dataArr['return'] = true;

        $content = Core::app()->getTemplate()->moduleContentView($dataArr);

        /*
          $dataArr['name_controller'] = 'newsitems';
          $dataArr['action'] = DEFAULT_ACTION_MODULE_FORM;
          $content .= Core::app()->getTemplate()->moduleContentView($dataArr, true);
         */
        //$this->echoPre($dataArr);
        $dataArr['content'] = $content;

        $content = Core::app()->getTemplate()->getWidget('form', $dataArr, null);


        Core::app()->getTemplate()->setVar('title_page', 'Редактирование группы: ' . $dataArr['name']);
        Core::app()->getTemplate()->setVar('content', $content);
    }

    public function update()
    {
        $post = Core::app()->getRequest()->getPost();

        if (!$this->isEmpty($post))
        {
            $id = $post['id'];
            $access['access'] = $post['access'];

            unset($post['id']);
            unset($post['access']);

            $this->loadModel('groups');
            $this->M_user_groups->updateGroupById($id, $post);
            $this->accessupdate($access);
            $url = Core::app()->getHtml()->createUrl('admin/groups');
            Core::app()->getRequest()->redirect($url, true, 302);
        }
    }

    public function delete($params = null)
    {
        $id = 0;
        if ($params != null && is_array($params))
        {
            $id = $params['id'];
        }
        else
        {
            $get = Core::app()->getRequest()->getGet();
            $id = $get['id'];
        }
        
        if ($id > 0)
        {
            $this->loadModel('groups');
            $this->M_user_groups->deleteGroup($get['id']);
            $this->M_user_groups->deleteGroupAccess($get['id']);

            $url = Core::app()->getHtml()->createUrl('admin/groups');
            Core::app()->getRequest()->redirect($url, true, 302);
        }
    }

    private function access($id)
    {
        $content = '';

        $this->loadModel('groups');

        // Получаем дефолтные настройки модулей по умолчанию (из файла конфига модулей)
        $modulesConfig = Core::app()->getConfig()->getAllModulesConfig();


        $dataArr['id_group'] = $id;

        // список доступов к екшенам  модулей из БД
        $group_access = $this->M_user_groups->getGroupAccess($id);
        $dataArr['modules'] = Core::app()->getConfig()->getConfigItem('modules');
//$this->echoPre($dataArr, false, true);
        // пробегаемся по установленным модулям в системе
        for ($i = 0; $i < count($dataArr['modules']); $i++)
        {
            // дефолтные настройки модуля по умолчанию (из файла конфига модуля)
            $module_default_access = $modulesConfig[$dataArr['modules'][$i]['name_system']];

            // пробегаемся по доступам из БД
            for ($y = 0; $y < count($group_access); $y++)
            {
                // если есть настройка прав доступа в БД к модулю
                if ($group_access[$y]['id_module'] == $dataArr['modules'][$i]['id_module'])
                {
                    $id = $group_access[$y]['id'];
                    $controller = $group_access[$y]['controller'];
                    $action = $group_access[$y]['action'];
                    $access_type = $group_access[$y]['access_type'];
                    $access_type_value = $group_access[$y]['access_type_value'];

                    // добавляем дефолтные настройки прав доступа с настроек прав доступа из БД если такие есть
                    if (isset($module_default_access['controller'][$controller]['action'][$action]['access_type']) && $module_default_access['controller'][$controller]['action'][$action]['access_type'] == $access_type
                    )
                    {
                        $module_default_access['controller'][$controller]['action'][$action]['id'] = $id;
                        $module_default_access['controller'][$controller]['action'][$action]['access_type_value'] = $access_type_value;
                    }
                }
            }


            $dataArr['modules'][$i]['access'] = $module_default_access;
        }

        //$this->echoPre($modulesConfig);
        //$this->echoPre($dataArr, false, true);
        $dataArr['form_action'] = 'admin/groups/accessupdate/';
        $dataArr['path'] = '';
        $dataArr['name_module'] = 'user';
        $dataArr['file_content_view'] = 'mod_groups_access.php';
        $dataArr['return'] = true;

        $content .= Core::app()->getTemplate()->moduleContentView($dataArr);

        return $content;
    }

    private function accessupdate($post)
    {
        $this->loadModel('groups');


        for ($i = 0; $i < count($post['access']); $i++)
        {
            for ($y = 0; $y < count($post['access'][$i]); $y++)
            {
                $actionAccess = $post['access'][$i][$y];

                if (isset($actionAccess['access_type_value']) && $actionAccess['access_type_value'] == 'on')
                {
                    $actionAccess['access_type_value'] = 1;
                }
                else
                {
                    $actionAccess['access_type_value'] = 0;
                }

                if ($actionAccess['id'] == 0)
                {
                    unset($actionAccess['id']);

                    $this->M_user_groups->setGroupAccess($actionAccess);
                }
                else
                {
                    $id = $actionAccess['id'];
                    unset($actionAccess['id']);

                    $this->M_user_groups->updateGroupAccessById($id, $actionAccess);
                }
            }
        }

        //$this->echoPre($post, false, true);
    }

    public function getModuleFormFildsConfig($dataArr = null)
    {
        
    }

    private function getDefaultGroupData($dataArr)
    {
        return $dataArr;
    }

    public function updateModuleFormFildsConfig($dataArr = null)
    {
        
    }

    public function deleteModuleDataById($dataArr)
    {
        $id = $dataArr['id'];
        $this->loadModule('M_crm_main', $this->getNameModule());

        $result = $this->M_crm_main->deleteCrmSettingsByModuleId($id);
    }

    public function hookUpdateUserGroupAccess($dataArr = null)
    {
        if ($dataArr != null && isset($dataArr[0]))
        {
            $userObject = $dataArr[0];

            $user = array();

            $userGroupModel = $this->loadModel('groups', 'user', true);



            if (!$userObject->isAuth())
            {
                $user = $this->getDefaultGroup($userGroupModel);

                //$this->echoPre($user, false, true);

                $userObject->createUserVars($user);
            }
            else
            {
                $userAuthModel = $this->loadModel('auth', 'user', true);
                $id_user = $userObject->getField('id');
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
                $userObject->login($user); //Обновляем данные в сессиии
            }
        }
    }

    private function getDefaultGroup($userGroupModel)
    {
        $user = array();
        $fromFile = false;
        $congig = Core::app()->getConfig();

        $setting = $congig->getConfigItem('settings');
        $id_group_default_unauthorized = $setting['group_default_unauthorized'];

        if ($userGroupModel != null && !$this->isEmpty($id_group_default_unauthorized) && $id_group_default_unauthorized > 0)
        {
            $user_group = $userGroupModel->getGroupById($id_group_default_unauthorized);
            $user_group_access = $userGroupModel->getGroupAccess($id_group_default_unauthorized);

            // Если прав доступа у группы нету или это id несуществующей группы
            // тогда будем брать из файла права доступа
            if ($user_group_access != null)
            {
                $user['id_group'] = $id_group_default_unauthorized;
                $user['group_name'] = $user_group['name'];
                $user['user_group_access'] = $user_group_access;
            }
            else
            {
                $fromFile = true;
            }
        }
        else
        {
            $fromFile = true;
        }

        if ($fromFile)
        {
            $default_groups = $congig->getConfigItem('default_groups');
            $default_role = $congig->getConfigItem('default_role');
            $default_user_group_access[] = $default_groups[$default_role['user_group']];


            $user['id_group'] = 0;
            $user['group_name'] = $default_role['user_group'];
            $user['user_group_access'] = $default_user_group_access;
        }


        return $user;
    }

    public function hookModuleGroupAccess($dataArr = null)
    {
        if ($dataArr != null)
        {
            $modulesNewArr = array();


            $config = $dataArr[0];
            $user = Core::app()->getUser();

            $userGroupAccess = $user->user_group_access;


            $modulesArr = $config->getConfigItem('modules');
            $modulesCount = count($modulesArr);
            $userGroupAccessCount = count($userGroupAccess);

            for ($i = 0; $i < $modulesCount; $i++)
            {
                $module = $modulesArr[$i];
                $validate = true;

                for ($y = 0; $y < $userGroupAccessCount; $y++)
                {
                    $groupModuleAccess = $userGroupAccess[$y];

                    if ($module['id_module'] == $groupModuleAccess['id_module'] && $groupModuleAccess['action'] == 'showDataByPosition' && $groupModuleAccess['access_type_value'] == 0)
                    {
                        $validate = false;
                    }
                }

                if ($validate)
                {
                    $modulesNewArr[] = $module;
                }
            }



            $config->setConfigItem('modules', $modulesNewArr);

            //$this->echoPre($modulesArr);
            //$this->echoPre($modulesNewArr);            
        }
    }

    public function hookMenuitemsGroupAccess($dataArr = null)
    {
        if ($dataArr != null)
        {

            $menuitems = $dataArr[0];
            $menuitemsNewArr = array();
            $user = Core::app()->getUser();
            $id_user_group = $user->getField('id_group');

            $userGroupModel = $this->loadModel('groups', 'user', true);
            // все доступы к пунктам меню для группы пользователя
            $allGroupMenuitemAccess = $userGroupModel->getGroupMenuitemAccess('id_group', $id_user_group);

            // пробегаемся по всем пунктам меню
            for ($i = 0; $i < count($menuitems); $i++)
            {
                $validate = true;
                $menuitem = $menuitems[$i];
                // пробегаемся по всем доступам группы для пункта меню из БД
                for ($y = 0; $y < count($allGroupMenuitemAccess); $y++)
                {
                    // если текущий пункт меню
                    if (($menuitem['id'] == $allGroupMenuitemAccess[$y]['id_menuitem']) && ($allGroupMenuitemAccess[$y]['is_active'] == 0))
                    {
                        $validate = false;
                        break;
                    }
                }

                if ($validate)
                {
                    $menuitemsNewArr[] = $menuitem;
                }
            }

            $dataArr[0] = $menuitemsNewArr;
            //$this->echoPre($menuitemsNewArr);
            //$this->echoPre($allGroupMenuitemAccess);            
        }
    }

    public function hookMenuitemsCreateGroupAccess($dataArr = null)
    {
        if ($dataArr != null)
        {
            $userGroupModel = $this->loadModel('groups', 'user', true);
            $allGroups = $userGroupModel->getAllGroups();

            $action = $dataArr[0];
            $idMenuitem = $dataArr[1];


            switch ($action)
            {
                case 'create':

                    $content = &$dataArr[2];
                    // Устанавливаем включеный чекбокс при создании нового пункта меню
                    for ($i = 0; $i < count($allGroups); $i++)
                    {
                        $allGroups[$i]['is_active'] = 1;
                    }

                    $dataArrGroup['all_groups'] = $allGroups;
                    $dataArrGroup['path'] = '';
                    $dataArrGroup['name_module'] = 'user';
                    $dataArrGroup['file_content_view'] = 'mod_group_menuitem_create.php';
                    $dataArrGroup['return'] = true;

                    $content .= Core::app()->getTemplate()->moduleContentView($dataArrGroup);

                    break;

                case 'set':

                    $post = $dataArr[2];

                    for ($i = 0; $i < count($allGroups); $i++)
                    {
                        $dataArrGroup['id_group'] = $allGroups[$i]['id'];
                        $dataArrGroup['id_menuitem'] = $idMenuitem;
                        $dataArrGroup['is_active'] = 0;

                        foreach ($post['groups'] as $idGroup => $value)
                        {
                            if ($allGroups[$i]['id'] == $idGroup)
                            {
                                $dataArrGroup['is_active'] = 1;
                                break;
                            }
                        }

                        $userGroupModel->setMenuitemGroupAccess($dataArrGroup);
                    }

                    break;

                case 'edite':

                    $content = &$dataArr[2];
                    $allMenuitemsGroupsAccess = $userGroupModel->getGroupMenuitemAccess('id_menuitem', $idMenuitem);

                    // пробегаемся по всем группам
                    for ($i = 0; $i < count($allGroups); $i++)
                    {
                        // Ставим чекбокс активным, если в БД есть настройка, то она перезапишет данную
                        $allGroups[$i]['is_active'] = 1;
                        // пробегаемся по всем группам связаных с пунктом меню
                        for ($y = 0; $y < count($allMenuitemsGroupsAccess); $y++)
                        {

                            // если текущая группа совпадает с группой связанной с пунктом меню
                            // то ставим установленную активность
                            if ($allGroups[$i]['id'] == $allMenuitemsGroupsAccess[$y]['id_group'])
                            {
                                $allGroups[$i]['is_active'] = $allMenuitemsGroupsAccess[$y]['is_active'];
                            }
                        }
                    }

                    $dataArrGroup['all_groups'] = $allGroups;
                    $dataArrGroup['path'] = '';
                    $dataArrGroup['name_module'] = 'user';
                    $dataArrGroup['file_content_view'] = 'mod_group_menuitem_create.php';
                    $dataArrGroup['return'] = true;

                    $content .= Core::app()->getTemplate()->moduleContentView($dataArrGroup);

                    break;

                case 'update':

                    $post = $dataArr[2];
                    $allMenuitemsGroupsAccess = $userGroupModel->getGroupMenuitemAccess('id_menuitem', $idMenuitem);

                    for ($i = 0; $i < count($allGroups); $i++)
                    {
                        $dataArrGroup['id_group'] = $allGroups[$i]['id'];
                        $dataArrGroup['id_menuitem'] = $idMenuitem;
                        $dataArrGroup['is_active'] = 0;
                        $id = 0;
                        // ищем id для обновления. Если нету, значит вносим новые данные 
                        //(походу новая группа появилась)
                        for ($y = 0; $y < count($allMenuitemsGroupsAccess); $y++)
                        {
                            if ($allGroups[$i]['id'] == $allMenuitemsGroupsAccess[$y]['id_group'])
                            {
                                $id = $allMenuitemsGroupsAccess[$y]['id'];
                                break;
                            }
                        }
                        // ищем в новых данных нашу группу
                        foreach ($post['groups'] as $idGroup => $value)
                        {
                            if ($allGroups[$i]['id'] == $idGroup)
                            {
                                $dataArrGroup['is_active'] = 1;
                                break;
                            }
                        }

                        if ($id == 0)
                        {
                            $userGroupModel->setMenuitemGroupAccess($dataArrGroup);
                        }
                        else
                        {
                            $userGroupModel->updateMenuitemGroupAccessById($id, $dataArrGroup);
                        }
                    }

                    break;

                case 'delete':

                    $userGroupModel->deleteMenuitemGroupAccess($idMenuitem);

                    break;
            }
        }
    }

}
?>