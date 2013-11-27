<?php

/**
 * Главный клас модуля, все запросы по умолчанию отправляются сюда
 * @author Веталь
 * @version 1.0
 * @updated 17-Вер-2013 20:15:13
 */
class C_user_main extends Controller
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
        $this->loadModel('main', 'user');

        Core::app()->getTemplate()->setVar('title_page', 'Список пользователей');

        $dataArr = $this->M_user_main->getAllUsers();

        $dataArr['link_edite'] = 'user/edite/';
        $dataArr['link_delete'] = 'user/delete/';
        //$this->echoPre($dataArr['link_edite']);
        $content = Core::app()->getTemplate()->getWidget('data_table', $dataArr);

        Core::app()->getTemplate()->setVar('content', $content);

        return 'index.tpl.php';
    }

    // Загружаем этот метод только для вывода в позиции модуля
    public function showDataByPosition($dataArr = null)
    {
        // $dataArr - данные для вызова модуля в позиции

        if ($dataArr != null)
        {
            $dataArr['path'] = '';
            $dataArr['name_module'] = $this->getNameModule();
            $dataArr['file_content_view'] = 'mod_user_auth_block.php';
            $dataArr['return'] = false;

            Core::app()->getTemplate()->moduleContentView($dataArr, false);
        }
    }

    public function create()
    {
        $post = Core::app()->getRequest()->getPost();

        $get = Core::app()->getRequest()->getGet();
        $this->loadModel('register', 'user');

        if (!$this->isEmpty($post))
        {
            unset($post['confirm_password']);

            $dataArr = $this->getDefaultUserData($post);


            $this->M_user_register->setUser($dataArr);

            $url = Core::app()->getHtml()->createUrl('admin/user');
            Core::app()->getRequest()->redirect($url, true, 302);
        }
        else
        {
            $dataArr = array();

            $dataArr['id'] = 0;
            $dataArr['form_action'] = 'admin/user/create';
            $dataArr['path'] = '';
            $dataArr['name_module'] = 'user'; // папка где брать файл
            $dataArr['file_content_view'] = 'mod_user_create.php';
            $dataArr['return'] = true;

            $dataArr['content'] = Core::app()->getTemplate()->moduleContentView($dataArr);
            $content = Core::app()->getTemplate()->getWidget('form', $dataArr, null);

            Core::app()->getTemplate()->setVar('title_page', 'Создание задания');
            Core::app()->getTemplate()->setVar('content', $content);
        }
    }

    public function delete()
    {
        $get = Core::app()->getRequest()->getGet();

        if (!$this->isEmpty($get))
        {
            $this->loadModel('register', 'user');

            $this->M_user_register->deleteUserById($get['id']);

            $url = Core::app()->getHtml()->createUrl('admin/user');
            Core::app()->getRequest()->redirect($url, true, 302);
        }
    }

    public function edite()
    {
        $get = Core::app()->getRequest()->getGet();

        if (!$this->isEmpty($get))
        {
            $this->loadModel('register', 'user');
            $userGroupModel = $this->loadModel('groups', 'user', true);
            
            $dataArr = $this->M_user_register->getUserById($get['id']);
            Core::app()->getTemplate()->setVar('title_page', 'Редактирование задачи');

            //$dataArr['root'] = 'Это проект';
            //$dataArr['rootStatus'] = 'Открытая';
            $dataArr['all_groups'] = $userGroupModel->getAllGroups();
            $dataArr['form_action'] = 'admin/user/update';
            $dataArr['path'] = '';
            $dataArr['name_module'] = 'user';
            $dataArr['file_content_view'] = 'mod_user_create.php';
            $dataArr['return'] = true;

            $content = Core::app()->getTemplate()->moduleContentView($dataArr);

            $dataArr['content'] = $content;

            $content = Core::app()->getTemplate()->getWidget('form', $dataArr, null);
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
            unset($post['confirm_password']);

            $this->loadModel('register', 'user');
            $this->M_user_register->updateUserById($id, $post);
            $url = Core::app()->getHtml()->createUrl('admin/user');
            Core::app()->getRequest()->redirect($url, true, 302);
        }
    }

    public function getModuleFormFildsConfig($dataArr = null)
    {

    }

    private function getDefaultUserData($dataArr)
    {
        if (is_array($dataArr))
        {
            $date = Date('H:i:s d-m-Y');


            if (isset($dataArr['date_create']) && $this->isEmpty($dataArr['date_create']))
            {
                $dataArr['date_create'] = $date;
            }
            else
            {
                $dataArr['date_create'] = $date;
            }
        }


        return $dataArr;
    }

    public function updateModuleFormFildsConfig($dataArr = null)
    {

    }

    public function deleteModuleDataById($dataArr)
    {

    }

}

?>