<?php

/**
 * Главный клас модуля, все запросы по умолчанию отправляются сюда
 * @author Веталь
 * @version 1.0
 * @updated 17-Вер-2013 20:15:13
 */
class C_crm_tasks extends Controller
{

    function __construct()
    {
        parent::__construct();

        $this->init();

        Core::app()->getTemplate()->setVar('createPath', 'crm/tasks/create');
        Core::app()->getTemplate()->setVar('createTitle', 'Создать новость/статью');
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

        if ($get != null)
        {
            $id_task = $get['id'];

            $this->loadModule('M_crm_tasks', 'crm');

            $dataArr = $this->M_crm_tasks->getTaskById($id_task);

            $dataArr['path'] = '';
            $dataArr['name_module'] = $this->getNameModule();
            $dataArr['file_content_view'] = 'mod_task_detail.php';
            $dataArr['return'] = true; //возвратить результат как текст (что б занести в переменную)

            $content = Core::app()->getTemplate()->moduleContentView($dataArr, false);

            Core::app()->getTemplate()->setVar('title_page', $dataArr['name']);

            Core::app()->getTemplate()->setVar('content', $content);

            return 'index.tpl.php'; // Тут нужно возвратить шаблон страницы отображения
        }
        else
        {
            Core::app()->getTemplate()->setVar('title_page', 'Не хватает данных');
            Core::app()->getTemplate()->setVar('content', 'Не хватает данных');
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
        $this->loadModule('M_crm_tasks', 'crm');

        if (!$this->isEmpty($post))
        {// Сделать проверку на валидность и пустоту
            // http://spuzom.ru/detail.php?id=249
            // Добавление в источник выдает ошибка ?i воспринимает как нашу инструкцию, переделать
            unset($post['id']);

            $post = $this->getDefaultTaskItemData($post);

            $this->M_crm_tasks->setTaskItem($post);

            $url = Core::app()->getHtml()->createUrl('crm');
            Core::app()->getRequest()->redirect($url, true, 302);
        }
        else
        {
            $this->loadModule('M_crm_status', 'crm');

            $dataArr = array();
            $id_parent = 0;

            if (isset($get['id_parent']) && !$this->isEmpty($get['id_parent']))
            {
                $id_parent = $get['id_parent'];
            }
            $dataArr['id'] = 0;
            $dataArr['root'] = 'Это проект';
            $dataArr['rootStatus'] = 'Без статуса';
            $dataArr['all_tasks'] = $this->M_crm_tasks->getAllTasks();
            $dataArr['all_statuses'] = $this->M_crm_status->getAllStatuses();
            $dataArr['id_parent'] = $id_parent;
            $dataArr['form_action'] = 'crm/tasks/create/';
            $dataArr['path'] = '';
            $dataArr['name_module'] = 'crm';
            $dataArr['file_content_view'] = 'admin_task_create.php';
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
            $this->loadModule('M_crm_tasks', 'crm');

            $id = $post['id'];
            unset($post['id']);

            if ($post['id_parent'] == $id)
            {
                $post['id_parent'] = 0;
            }


            $post = $this->getDefaultTaskItemData($post);

            $this->M_crm_tasks->updateTaskById($id, $post);

            $url = Core::app()->getHtml()->createUrl('crm');
            Core::app()->getRequest()->redirect($url, true, 302);
        }
    }

    public function edite()
    {
        $post = Core::app()->getRequest()->getGet();

        if (!$this->isEmpty($post))
        {
            $this->loadModule('M_crm_tasks', 'crm');
            $this->loadModule('M_crm_status', 'crm');

            $dataArr = $this->M_crm_tasks->getTaskById($post['id']);
            Core::app()->getTemplate()->setVar('title_page', 'Редактирование задачи');

            $dataArr['root'] = 'Это проект';
            $dataArr['rootStatus'] = 'Без статуса';
            $dataArr['all_tasks'] = $this->M_crm_tasks->getAllTasks();
            $dataArr['all_statuses'] = $this->M_crm_status->getAllStatuses();
            $dataArr['form_action'] = 'crm/tasks/update/';
            $dataArr['path'] = '';
            $dataArr['name_module'] = 'crm';
            $dataArr['file_content_view'] = 'admin_task_create.php';
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
            $this->loadModule('M_crm_tasks', 'crm');

            $this->M_crm_tasks->deleteTaskById($get['id']);

            $url = Core::app()->getHtml()->createUrl('crm');
            Core::app()->getRequest()->redirect($url, true, 302);
        }
    }

    public function getModuleFormFildsConfig($dataArr = null)
    {
        $content = '';

        return $content;
    }

    private function getDefaultTaskItemData($dataArr)
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

    public function deleteModuleDataById($id)
    {
        
    }

}

?>