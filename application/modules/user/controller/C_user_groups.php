﻿<?php

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

        $dataArr['link_access'] = 'groups/access/';
        $dataArr['link_edite'] = 'groups/edite/';
        $dataArr['link_delete'] = 'groups/delete/';
        //$this->echoPre($dataArr['link_edite']);
        $content = Core::app()->getTemplate()->getWidget('data_table2', $dataArr);


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

        $this->echoPre($user->getField('id'));
        Core::app()->echoPre($user->getUserSession());

        $post = Core::app()->getRequest()->getPost();

        $this->loadModel('groups');

        if (!$this->isEmpty($post))
        {
            $dataArr = $this->getDefaultGroupData($post);


            $this->M_user_groups->setGroup($dataArr);

            $url = Core::app()->getHtml()->createUrl('admin/groups');
            Core::app()->getRequest()->redirect($url, true, 302);
        }
        else
        {
            $dataArr = array();
            $dataArr['all_groups'] = $this->M_user_groups->getAllGroups();
            $dataArr['root'] = 'Без родителя';
            $dataArr['id'] = 0;
            $dataArr['id_parent'] = 0;
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

    public function edite()
    {
        $get = Core::app()->getRequest()->getGet();

        if (!$this->isEmpty($get))
        {
            $this->loadModel('groups');
            $dataArr = $this->M_user_groups->geGroupById($get['id']);
            $dataArr['all_groups'] = $this->M_user_groups->getAllGroups();
            $dataArr['root'] = 'Без родителя';
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
            Core::app()->getTemplate()->setVar('title_page', 'редактирование группы');
            Core::app()->getTemplate()->setVar('content', $content);
        }
    }

    public function update()
    {
        $post = Core::app()->getRequest()->getPost();

        if (!$this->isEmpty($post))
        {
            $id = $post['id'];
            unset($post['id']);

            $this->loadModel('groups');
            $this->M_user_groups->updateGroupById($id, $post);
            $url = Core::app()->getHtml()->createUrl('admin/groups');
            Core::app()->getRequest()->redirect($url, true, 302);
        }
    }

    public function delete()
    {
        $get = Core::app()->getRequest()->getGet();

        if (!$this->isEmpty($get))
        {
            $this->loadModel('groups');
            $this->M_user_groups->deleteGroup($get['id']);

            $url = Core::app()->getHtml()->createUrl('admin/groups');
            Core::app()->getRequest()->redirect($url, true, 302);
        }
    }

    public function access()
    {
        $get = Core::app()->getRequest()->getGet();

        if (!$this->isEmpty($get))
        {
            $this->loadModel('groups');
            $dataArr = $this->M_user_groups->geGroupById($get['id']);
            $dataArr['all_groups'] = $this->M_user_groups->getAllGroups();
            $dataArr['root'] = 'Без родителя';
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
            Core::app()->getTemplate()->setVar('title_page', 'редактирование группы');
            Core::app()->getTemplate()->setVar('content', $content);
        }
    }

    public function accessupdate()
    {

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

}

?>