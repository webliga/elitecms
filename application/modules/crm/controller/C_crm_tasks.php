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

        if ($get != null /* && isset($get['show_me']) && $get['show_me'] == 'vitagro' */)
        {
            $id_task = $get['id'];

            $this->loadModel('tasks', 'crm');

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

    private function changeParentStatus($id_parent, $allTasks)
    {
        $this->loadModel('tasks', 'crm');
        $this->loadModel('main', 'crm');
        for ($i = 0; $i < count($allTasks); $i++)
        {
            if ($id_parent == $allTasks[$i]['id'])
            {
                $parentTask = $allTasks[$i];
                $moduleSetting = $this->M_crm_main->getCrmSettingsByModuleId($parentTask['id_module']);
                // Пробегаемся по всем родителям и меняем их статус в зависимости от условий
                // до того момента, пока $id_parent станет равным 0
                for ($y = 0; $y < count($allTasks); $y++)
                {// Если это наш родитель
                    if ($id_parent == $allTasks[$y]['id'])
                    {
                        $parentTask = $allTasks[$y];
                        $y = 0; //что б не пропустить вышестоящего родителя, будем начинать цикл сначала, пока не встретим id_parent == 0
                        // Получаем id слудующего родителя  (родителя над родителем)
                        $id_parent = $parentTask['id_parent'];

                        if ($parentTask['crm_statuses_is_complete'] == 1)
                        {// Если есть тот кто отвечает за проэкт
                            if ($parentTask['id_responsible'] != 0)
                            {
                                $parentTaskUpdateData['id_status'] = $moduleSetting['id_status_work'];
                            }
                            else
                            {
                                $parentTaskUpdateData['id_status'] = 0;
                            }

                            $this->M_crm_tasks->updateTaskById($parentTask['id'], $parentTaskUpdateData);
                        }
                        // Если нет следующего родителя, то завершаем цикл                       
                        if ($id_parent == 0)
                        {
                            break;
                        }
                    }
                }

                break;
            }
        }
    }

    public function create()
    {
        $post = Core::app()->getRequest()->getPost();

        $get = Core::app()->getRequest()->getGet();
        $this->loadModel('tasks', 'crm');

        if (!$this->isEmpty($post))
        {
            $this->loadModel('tasks', 'crm');
            $this->loadModel('main', 'crm');
            $allTasks = $this->M_crm_tasks->getAllTasks();

            $id_parent = $post['id_parent'];

            $this->changeParentStatus($id_parent, $allTasks);

            unset($post['id']);

            $post = $this->getDefaultTaskItemData($post);

            $this->M_crm_tasks->setTaskItem($post);

            $url = Core::app()->getHtml()->createUrl('crm');
            Core::app()->getRequest()->redirect($url, true, 302);
        }
        else
        {
            $this->loadModel('status', 'crm');

            $dataArr = array();
            $id_parent = 0;

            if (isset($get['id_parent']) && !$this->isEmpty($get['id_parent']))
            {
                $id_parent = $get['id_parent'];
            }
            $dataArr['id'] = 0;
            $dataArr['root'] = 'Это проект';
            $dataArr['rootStatus'] = 'Открытая';
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
            $id = $post['id'];
            $this->loadModel('tasks', 'crm');

            $canChange = true;
            $allTasks = $this->M_crm_tasks->getAllTasks();


// Проверяем все ли подзадачи имеют статус закрытого типа
            for ($i = 0; $i < count($allTasks); $i++)
            {// Если это подзадача и у нее не закрытого типа статус
                if ($id == $allTasks[$i]['id_parent'] && $allTasks[$i]['crm_statuses_is_complete'] != 1)
                {
                    $canChange = false;
                    $this->loadModel('status', 'crm');
                    $allStatuses = $this->M_crm_status->getAllStatuses();
                    // Проверяем, а вдру мы меняем не на закрытый а на открытый статус
                    for ($y = 0; $y < count($allStatuses); $y++)
                    {
                        if ($post['id_status'] == $allStatuses[$y]['id'] && $allStatuses[$y]['is_complete'] != 1 || $post['id_status'] == 0)
                        {
                            $canChange = true;
                            break;
                        }
                    }
                    break;
                }
            }

            if ($canChange)
            {
                unset($post['id']);


                if ($post['id_parent'] == $id)
                {
                    $post['id_parent'] = 0;
                }

                $id_parent = $post['id_parent'];
                $this->changeParentStatus($id_parent, $allTasks);

                $post = $this->getDefaultTaskItemData($post);
                $this->M_crm_tasks->updateTaskById($id, $post);

                $url = Core::app()->getHtml()->createUrl('crm');
                Core::app()->getRequest()->redirect($url, true, 302);
            }
            else
            {
                $content = 'Изменение статуса для задачи не возможно. <br />Причина: Не все подзадачи имеют закрытый тип статуса';


                Core::app()->getTemplate()->setVar('content', $content);
            }
        }
    }

    public function edite()
    {
        $post = Core::app()->getRequest()->getGet();
$this->echoPre($post);
        if (!$this->isEmpty($post))
        {
            $this->loadModel('tasks', 'crm');
            $this->loadModel('status', 'crm');

            $dataArr = $this->M_crm_tasks->getTaskById($post['id']);
            Core::app()->getTemplate()->setVar('title_page', 'Редактирование задачи');

            $dataArr['root'] = 'Это проект';
            $dataArr['rootStatus'] = 'Открытая';
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
            $this->loadModel('tasks', 'crm');

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
            // id_module будет существовать только в случае если обновляет или создает задание супер администратор
            // при других случаях id_module существовать не будет, а будет браться из привязки к группе
            // что настраивается в модуле CRM
            if (isset($dataArr['id_module']) && $this->isEmpty($dataArr['id_module']))
            {
                $dataArr['id_module'] = 29; // Вместо 29 будет стоять id модуля, к которому привязана группа пользователя
            }
            else
            {
                $dataArr['id_module'] = 29;
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