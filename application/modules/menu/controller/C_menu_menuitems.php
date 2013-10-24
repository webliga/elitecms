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
        {// Сделать проверку на валидность и пустоту
            $this->loadModule('M_menu_menuitems', 'menu');
            
            unset($post['id']);

            if (isset($post['is_active']))
            {
                $post['is_active'] = true;
            }
            else
            {
                $post['is_active'] = false;
            }

            $this->M_menu_menuitems->setMenuItem($post);

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

            $dataArr['name_system'] = 'menu';
            $dataArr['name_controller'] = 'menuitems';
            $dataArr['action'] = DEFAULT_ACTION_MODULE_FORM;
            $content .= Core::app()->getTemplate()->moduleContentView($dataArr, true);

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

            if (isset($post['is_active']))
            {
                $post['is_active'] = true;
            }
            else
            {
                $post['is_active'] = false;
            }

            // На всяк случай проверяем, а не является ли родителем сам пункт меню
            // Если да, то не меняем родителя
            if ($id == $post['id_parent'])
            {
                unset($post['id_parent']);
            }
            //Core::app()->echoPre($post); 
            //Core::app()->echoPre($dataArr);

            $this->M_menu_menuitems->updateMenuitemById($id, $post);

            $url = Core::app()->getHtml()->createUrl('admin/menuitems');
            Core::app()->getRequest()->redirect($url, true, 302);
        }
    }

    public function edite()
    {
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
            $this->loadModule('M_menu_menuitems', $this->getNameModule());

            $dataOptionArr = $this->M_menu_menuitems->getAllMenuItems();

            $dataArr = $this->getDefaultMenuItemData($dataArr);

            $dataArr['select_all_items'] = $dataOptionArr;
            $dataArr['select'] = 'form_select';
            $dataArr['select_name'] = 'id_parent';
            $dataArr['select_lable'] = 'Родительский пункт меню:';
            $dataArr['option_value_selected'] = $dataArr['id_parent']; // Существующий родительский пункт

            $y = 0;

            $dataArr['select_data'][$y]['option_value'] = 0;
            $dataArr['select_data'][$y]['option_text'] = 'Корень меню';
            $y++;
            
            // Формируем текущий список родительских пунктов меню
            for ($i = 0; $i < count($dataOptionArr); $i++)
            {
                if ($dataArr['id_module'] == $dataOptionArr[$i]['id_module'] && $dataArr['id'] != $dataOptionArr[$i]['id'])
                {
                    $dataArr['select_data'][$y]['option_value'] = $dataOptionArr[$i]['id'];
                    $dataArr['select_data'][$y]['option_text'] = $dataOptionArr[$i]['name'];
                    $y++;
                }
            }

            $content .= Core::app()->getHtml()->createSelect($dataArr);


            $dataArr['input_name'] = 'priority';
            $dataArr['input_value'] = $dataArr['priority'];
            $dataArr['input_lable'] = 'Очередь показа';
            $content .= Core::app()->getHtml()->createInput($dataArr);

            $dataArr['input_name'] = 'class_li';
            $dataArr['input_value'] = $dataArr['class_li'];
            $dataArr['input_lable'] = 'Индивидуальный класс для пункта меню (li)';
            $content .= Core::app()->getHtml()->createInput($dataArr);

            // Третий параметр указывает, что виджет нужно искать в папке с шаблоном    
            $content .= Core::app()->getTemplate()->getWidget('menuitems_js', $dataArr, true);
        }

        return $content;
    }

    private function getDefaultMenuItemData($dataArr)
    {
        if (is_array($dataArr))
        {
            if (!isset($dataArr['id_module']) || $this->isEmpty($dataArr['id_module']))
            {
                $dataArr['id_module'] = 1;
            }

            if (!isset($dataArr['priority']) || $this->isEmpty($dataArr['priority']))
            {
                $dataArr['priority'] = 0;
            }

            if (!isset($dataArr['id_parent']) || $this->isEmpty($dataArr['id_parent']))
            {
                $dataArr['id_parent'] = 0;
            }

            if (!isset($dataArr['id']) || $this->isEmpty($dataArr['id']))
            {
                $dataArr['id'] = 0;
            }

            if (!isset($dataArr['class_li']) || $this->isEmpty($dataArr['class_li']))
            {
                $dataArr['class_li'] = '';
            }                         
        }

        return $dataArr;
    }

    public function updateModuleFormFildsConfig($dataArr = null)
    {
        
    }

    public function deleteModuleDataById($id)
    {
        
    }

}

?>