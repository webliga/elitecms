<?php

/**
 * Главный клас модуля, все запросы по умолчанию отправляются сюда
 * @author Веталь
 * @version 1.0
 * @updated 17-Вер-2013 20:15:13
 */
class C_menu_menuitems extends Controller
{

    function __construct()
    {
        parent::__construct();

        $this->init();

        Core::app()->getTemplate()->setVar('createPath', 'menuitems/create');
    }

    function __destruct()
    {
        
    }

    /**
     * Действие по умолчанию
     */
    public function index($dataArr = NULL)
    {
        $post = Core::app()->getRequest()->getPost();

        if ($this->isEmpty($post))
        {
            $this->loadModule('M_menu_menuitems', 'menu');

            Core::app()->getTemplate()->setVar('title_page', 'Пункты меню');

            $dataArr = $this->M_menu_menuitems->getAllMenuItems();
            $dataArr['form_action_edite'] = 'admin/menuitems/edite';
            $dataArr['form_action_delete'] = 'admin/menuitems/delete';
            $dataArr['name_hidden'] = 'id_item';

            $content = Core::app()->getTemplate()->getWidget('listview_table', $dataArr, null);

            Core::app()->getTemplate()->setVar('content', $content);
        }
    }

    public function create()
    {

        $post = Core::app()->getRequest()->getPost();

        if (!$this->isEmpty($post))
        {
            $this->loadModule('M_menu_menuitems', 'menu');

            $dataArr['name'] = $post['name'];
            $dataArr['link'] = $post['link'];
            $dataArr['title'] = $post['title'];
            $dataArr['id_module'] = $post['id_module'];

            if (isset($post['is_active']))
            {
                $dataArr['is_active'] = true;
            }
            else
            {
                $dataArr['is_active'] = false;
            }

            $this->M_menu_menuitems->setMenuItem($dataArr);

            $url = Core::app()->getHtml()->createUrl('admin/menuitems');
            Core::app()->getRequest()->redirect($url, true, 302);
        }
        else
        {
            $this->loadModule('M_admin_modules', 'admin');

            $dataArr = array();
            $dataArr['form_action'] = 'admin/menuitems/create/';
            $dataArr['all_menu_modules'] = $this->M_admin_modules->getAllModules('menu');
            $dataArr['path'] = '';
            $dataArr['name_module'] = 'admin';
            $dataArr['file_content_view'] = 'mod_admin_menuitem_create.php';
            $dataArr['return'] = true;

            $content = Core::app()->getTemplate()->moduleContentView($dataArr);
            $dataArr['content'] = $content;

            $content = Core::app()->getTemplate()->getWidget('form', $dataArr, null);
            Core::app()->getTemplate()->setVar('title_page', 'Создание пункта меню');
            Core::app()->getTemplate()->setVar('content', $content);
        }
    }

    public function update()
    {
        $post = Core::app()->getRequest()->getPost();

        if (!$this->isEmpty($post))
        {
            $this->loadModule('M_menu_menuitems', 'menu');

            $id = $post['id'];


            $dataArr['name'] = $post['name'];
            $dataArr['link'] = $post['link'];
            $dataArr['title'] = $post['title'];
            $dataArr['id_module'] = $post['id_module'];
            $dataArr['id_parent'] = $post['id_parent'];
            
            if (isset($post['is_active']))
            {
                $dataArr['is_active'] = true;
            }
            else
            {
                $dataArr['is_active'] = false;
            }

            //Core::app()->echoPre($post); 
            //Core::app()->echoPre($dataArr);

            $this->M_menu_menuitems->updateMenuitemById($id, $dataArr);

            $url = Core::app()->getHtml()->createUrl('admin/menuitems');
            Core::app()->getRequest()->redirect($url, true, 302);
        }
    }

    public function edite()
    {
        // Нужно создать функцию проверки дочерних элементов у пункта меню
        // Элементы которые являются дочерними не показывать в селекте "Родительский пункт меню"
        $post = Core::app()->getRequest()->getPost();

        if (!$this->isEmpty($post))
        {
            $this->loadModule('M_menu_menuitems', 'menu');
            $this->loadModule('M_admin_modules', 'admin');

            $dataArr = $this->M_menu_menuitems->getMenuItemById($post['id_item']);

            Core::app()->getTemplate()->setVar('title_page', 'Редактирование пункта меню');

            $dataArr['form_action'] = 'admin/menuitems/update/';
            $dataArr['all_menu_modules'] = $this->M_admin_modules->getAllModules('menu');
            $dataArr['path'] = '';
            $dataArr['name_module'] = 'admin';
            $dataArr['file_content_view'] = 'mod_admin_menuitem_create.php';
            $dataArr['return'] = true;

            $content = Core::app()->getTemplate()->moduleContentView($dataArr);

            $dataArr['name_controller'] = 'menuitems';
            $dataArr['action'] = DEFAULT_ACTION_MODULE_FORM;
            $content .= Core::app()->getTemplate()->moduleContentView($dataArr, true);


            $dataArr['content'] = $content;

            $content = Core::app()->getTemplate()->getWidget('form', $dataArr, null);
            Core::app()->getTemplate()->setVar('content', $content);
        }
    }

    public function delete()
    {
        $post = Core::app()->getRequest()->getPost();

        if (!$this->isEmpty($post))
        {
            $this->loadModule('M_menu_menuitems', 'menu');

            $this->M_menu_menuitems->deleteMenuItemById($post['id_item']);

            $url = Core::app()->getHtml()->createUrl('admin/menuitems');
            Core::app()->getRequest()->redirect($url, true, 302);
        }
    }

    public function getModuleFormFildsConfig($dataArr = null)
    {
        $content = '';

        if ($dataArr != null)
        {
            if (!$this->isEmpty($dataArr['id_parent']))
            {
                $this->loadModule('M_menu_menuitems', $this->getNameModule());

                $dataOptionArr = $this->M_menu_menuitems->getAllMenuItems();
                $dataArr['select_all_items'] = $dataOptionArr;
                $dataArr['select'] = 'form_select';
                $dataArr['select_name'] = 'id_parent';
                $dataArr['select_lable'] = 'Родительский пункт меню:';
                $dataArr['option_value_selected'] = $dataArr['id_parent']; // Существующий родительский пункт

                $y = 0;
                
                $dataArr['select_data'][$y]['option_value'] = 0;
                $dataArr['select_data'][$y]['option_text'] = 'Корень меню';
                $y++;

                for ($i = 0; $i < count($dataOptionArr); $i++)
                {
                    if ($dataArr['id_module'] == $dataOptionArr[$i]['id_module'] && $dataArr['id'] != $dataOptionArr[$i]['id'])
                    {
                        $dataArr['select_data'][$y]['option_value'] = $dataOptionArr[$i]['id'];
                        $dataArr['select_data'][$y]['option_text'] = $dataOptionArr[$i]['name'];
                        $y++;
                    }
                }

                $content = Core::app()->getHtml()->createSelect($dataArr);
                
                $content .= Core::app()->getTemplate()->getWidget('menuitems_js', $dataArr, true);
                
                //$this->echoPre($dataArr);
                //$this->echoPre($dataOptionArr);
            }
        }

        return $content;
    }

    public function updateModuleFormFildsConfig($dataArr = null)
    {
        
    }

    public function deleteModuleDataById($id)
    {
        
    }

}

?>