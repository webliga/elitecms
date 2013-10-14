<?php

/**
 * Главный клас модуля, все запросы по умолчанию отправляются сюда
 * @author Веталь
 * @version 1.0
 * @updated 17-Вер-2013 20:15:13
 */
class C_admin_menuitems extends Controller
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
    public function index()
    {
        $post = Core::app()->getRequest()->getPost();

        if ($this->isEmpty($post))
        {
            $this->loadModel('M_menu_menuitems', 'menu');

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
            $this->loadModel('M_menu_menuitems', 'menu');

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
            $this->loadModel('M_admin_modules', $this->getNameModule());
            
            
            $dataArr = array();
            $dataArr['form_action'] = 'admin/menuitems/create/';
            $dataArr['all_menu_moduless'] = $this->M_admin_modules->getAllModules('menu');
            
            
            $content = Core::app()->getTemplate()->moduleContentView(null, 'admin', $dataArr, 'mod_admin_menuitem_create.php', true);
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
            $this->loadModel('M_menu_menuitems', 'menu');

            $id = $post['id'];


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

            //Core::app()->echoPre($post); 
            //Core::app()->echoPre($dataArr);

            $this->M_menu_menuitems->updateMenuitemById($id, $dataArr);

            $url = Core::app()->getHtml()->createUrl('admin/menuitems');
            Core::app()->getRequest()->redirect($url, true, 302);
        }
    }

    public function edite()
    {
        $post = Core::app()->getRequest()->getPost();

        if (!$this->isEmpty($post))
        {
            $this->loadModel('M_menu_menuitems', 'menu');
            $this->loadModel('M_admin_modules', $this->getNameModule());
            
            $dataArr = $this->M_menu_menuitems->getMenuItemById($post['id_item']);

            Core::app()->getTemplate()->setVar('title_page', 'Редактирование пункта меню');

            $dataArr['form_action'] = 'admin/menuitems/update/';
            $dataArr['all_menu_moduless'] = $this->M_admin_modules->getAllModules('menu');
            
            $content = Core::app()->getTemplate()->moduleContentView(null, 'admin', $dataArr, 'mod_admin_menuitem_create.php', true);

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
            $this->loadModel('M_menu_menuitems', 'menu');

            $this->M_menu_menuitems->deleteMenuItemById($post['id_item']);

            $url = Core::app()->getHtml()->createUrl('admin/menuitems');
            Core::app()->getRequest()->redirect($url, true, 302);
        }
    }

}

?>