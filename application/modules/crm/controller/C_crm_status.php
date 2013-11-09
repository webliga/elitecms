<?php

/**
 * Главный клас модуля, все запросы по умолчанию отправляются сюда
 * @author Веталь
 * @version 1.0
 * @updated 17-Вер-2013 20:15:13
 */
class C_crm_status extends Controller
{

    function __construct()
    {
        parent::__construct();

        $this->init();

        Core::app()->getTemplate()->setVar('createPath', 'crm/status/create');
        Core::app()->getTemplate()->setVar('createTitle', 'Создать статус');
    }

    function __destruct()
    {
        
    }

    /**
     * Действие по умолчанию
     */
    public function index($dataArr = NULL)
    {
        $get = Core::app()->getRequest()->getGet();

        $this->loadModule('M_crm_status', 'crm');
        
        if ($get != null)
        {
            $id_status = $get['id'];


            $dataArr = $this->M_crm_status->getStatusById($id_status);

            $dataArr['path'] = '';
            $dataArr['name_module'] = $this->getNameModule();
            $dataArr['file_content_view'] = 'mod_status_detail.php';
            $dataArr['return'] = true; //возвратить результат как текст (что б занести в переменную)

            $content = Core::app()->getTemplate()->moduleContentView($dataArr, false);

            Core::app()->getTemplate()->setVar('title_page', $dataArr['name']);

            Core::app()->getTemplate()->setVar('content', $content);

            return 'index.tpl.php'; // Тут нужно возвратить шаблон страницы отображения
        }
        else
        {

            $content = '';
            // Если существуют GET данные - $dataArr
            // показываем статью по id
            // Если нету GET данных, значит неправильно набран URL или без параметров

            $get = Core::app()->getRequest()->getGet();

            $this->loadModule('M_crm_status', 'crm');

            $classArr['menu_ul'] = 'menu_ul';
            $classArr['menu_ul_level'] = 'menu_ul_level';
            $classArr['menu_li'] = 'menu_li';
            $classArr['menu_a'] = 'menu_span';
            $classArr['menu_span'] = 'menu_a';

            $dataArr['statuses'] = $this->M_crm_status->getAllStatuses();
            $dataArr['path'] = '';
            $dataArr['name_module'] = $this->getNameModule();
            $dataArr['file_content_view'] = 'mod_status_list.php';
            $dataArr['return'] = true; //возвратить результат как текст (что б занести в переменную)

            $content .= Core::app()->getTemplate()->moduleContentView($dataArr, false);
            Core::app()->getTemplate()->setVar('title_page', 'Список статусов');

            Core::app()->getTemplate()->setVar('content', $content);
        }
    }

    // Загружаем этот метод только для вывода в позиции модуля
    public function showDataByPosition($dataArr = null)
    {
        
    }

    public function create()
    {
        $post = Core::app()->getRequest()->getPost();

        $get = Core::app()->getRequest()->getGet();
        $this->loadModule('M_crm_status', 'crm');

        if (!$this->isEmpty($post))
        {// Сделать проверку на валидность и пустоту
            // http://spuzom.ru/detail.php?id=249
            // Добавление в источник выдает ошибка ?i воспринимает как нашу инструкцию, переделать
            unset($post['id']);

            $post = $this->getDefaultStatusItemData($post);

            $this->M_crm_status->setStatusItem($post);

            $url = Core::app()->getHtml()->createUrl('crm/status');
            Core::app()->getRequest()->redirect($url, true, 302);
        }
        else
        {
            $dataArr = array();

            $dataArr['id'] = 0;
            //$dataArr['root'] = 'Это проект';
            //$dataArr['all_tasks'] = $this->M_crm_tasks->getAllTasks();
            //$dataArr['id_parent'] = $id_parent;
            $dataArr['form_action'] = 'crm/status/create/';
            $dataArr['path'] = '';
            $dataArr['name_module'] = 'crm';
            $dataArr['file_content_view'] = 'admin_status_create.php';
            $dataArr['return'] = true;

            $dataArr['content'] = Core::app()->getTemplate()->moduleContentView($dataArr);
            $content = Core::app()->getTemplate()->getWidget('form', $dataArr, null);

            Core::app()->getTemplate()->setVar('title_page', 'Создание задания');
            Core::app()->getTemplate()->setVar('content', $content);
        }
    }

    public function update()
    {
        $post = Core::app()->getRequest()->getPost();

        if (!$this->isEmpty($post))
        {
            $this->loadModule('M_crm_status', 'crm');

            $id = $post['id'];
            unset($post['id']);

            $post = $this->getDefaultStatusItemData($post);

            $this->M_crm_status->updateStatusById($id, $post);

            $url = Core::app()->getHtml()->createUrl('crm/status');
            Core::app()->getRequest()->redirect($url, true, 302);
        }
    }

    public function edite()
    {
        $post = Core::app()->getRequest()->getGet();

        if (!$this->isEmpty($post))
        {
            $this->loadModule('M_crm_status', 'crm');
            //$this->loadModule('M_category_categoryitems', 'category');

            $dataArr = $this->M_crm_status->getStatusById($post['id']);
            Core::app()->getTemplate()->setVar('title_page', 'Редактирование статуса');

            //$dataArr['root'] = 'Это проект';
            //$dataArr['all_tasks'] = $this->M_crm_status->getAllStatuses();
            $dataArr['form_action'] = 'crm/status/update/';
            $dataArr['path'] = '';
            $dataArr['name_module'] = 'crm';
            $dataArr['file_content_view'] = 'admin_status_create.php';
            $dataArr['return'] = true;

            $content = Core::app()->getTemplate()->moduleContentView($dataArr);

            /*
              $dataArr['name_controller'] = 'Crmitems';
              $dataArr['action'] = DEFAULT_ACTION_MODULE_FORM;
              $content .= Core::app()->getTemplate()->moduleContentView($dataArr, true);
             */
            //$this->echoPre($dataArr);
            $dataArr['content'] = $content;

            $content = Core::app()->getTemplate()->getWidget('form', $dataArr, null);
            Core::app()->getTemplate()->setVar('content', $content);
        }
    }

    public function delete()
    {
        $get = Core::app()->getRequest()->getGet();

        if (!$this->isEmpty($get))
        {
            $this->loadModule('M_crm_status', 'crm');

            $this->M_crm_status->deleteStatusById($get['id']);

            $url = Core::app()->getHtml()->createUrl('crm/status');
            Core::app()->getRequest()->redirect($url, true, 302);
        }
    }

    public function getModuleFormFildsConfig($dataArr = null)
    {
        $content = '';

        return $content;
    }

    private function getDefaultStatusItemData($dataArr)
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

            if (isset($dataArr['is_complete']) && !$this->isEmpty($dataArr['is_complete']))
            {
                $dataArr['is_complete'] = 1;
            }
            else
            {
                $dataArr['is_complete'] = 0;
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