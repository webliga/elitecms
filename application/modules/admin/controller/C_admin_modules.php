<?php

/**
 * Главный клас модуля, все запросы по умолчанию отправляются сюда
 * @author Веталь
 * @version 1.0
 * @updated 17-Вер-2013 20:15:13
 */
class C_admin_modules extends Controller
{

    function __construct()
    {
        parent::__construct();

        $this->init();

        Core::app()->getTemplate()->setVar('createPath', 'modules/create');
    }

    function __destruct()
    {
        
    }

    /**
     * Действие по умолчанию
     */
    public function index($dataArr = null)
    {
        $post = Core::app()->getRequest()->getPost();

        if ($this->isEmpty($post))
        {
            $this->loadModel('M_admin_modules', $this->getNameModule());

            Core::app()->getTemplate()->setVar('title_page', 'Список модулей');

            $dataArr = $this->M_admin_modules->getAllModules();

            $dataArr['form_action_edite'] = 'admin/modules/edite';
            $dataArr['form_action_delete'] = 'admin/modules/delete';
            $dataArr['name_hidden'] = 'id_module';

            // Переделать под метод createTable
            $content = Core::app()->getTemplate()->getWidget('listview_table', $dataArr, false);

            Core::app()->getTemplate()->setVar('content', $content);
        }
    }

    public function create()
    {
        $post = Core::app()->getRequest()->getPost();
        $this->loadModel('M_admin_modules', $this->getNameModule());

        if (!$this->isEmpty($post))
        {
            $dataArr['name'] = $post['name'];
            $dataArr['name_system'] = $post['name_system'];
            $dataArr['description'] = $post['description'];
            $dataArr['id_position'] = $post['id_position'];

            $this->M_admin_modules->setModule($dataArr);

            $url = Core::app()->getHtml()->createUrl('admin/modules');
            Core::app()->getRequest()->redirect($url, true, 302);
        }
        else
        { 
            $this->loadModel('M_admin_position', $this->getNameModule());
            
            $dataArr = array();
            $dataArr['form_action'] = 'admin/modules/create/';
            $dataArr['all_positions'] = $this->M_admin_position->getAllPositions();
            $dataArr['all_modules'] = $this->M_admin_modules->getAllModules();
            // фильтруем на уникальность системного имени
            $dataArr['all_modules'] = $this->getUniqBySysNameModuleList($dataArr['all_modules']);
            $dataArr['path'] = ''; // абсолютный путь к файлу отображения, если пустой, то формируется дальше
            $dataArr['name_module'] = 'admin';
            $dataArr['file_content_view'] = 'mod_admin_module_create.php';
            $dataArr['return'] = true; // возвратить результат работы в переменную, если false, то отображаем сразу
            $dataArr['create'] = true; // Если создание нового, то чекбокс "Активное" делаем неактивным, так как мы сразу не подгрузим нужные файлы для детальной настройки модуля
            
            $content = Core::app()->getTemplate()->moduleContentView($dataArr, false);
            
            $dataArr['content'] = $content;
            // переделать под createForm
            $content = Core::app()->getTemplate()->getWidget('form', $dataArr, null);
            
            Core::app()->getTemplate()->setVar('title_page', 'Создание модуля');
            Core::app()->getTemplate()->setVar('content', $content);
        }
    }

    public function update()
    {
        $post = Core::app()->getRequest()->getPost();

        if (!$this->isEmpty($post))
        {   
            $this->loadModel('M_admin_modules', $this->getNameModule());
            
            $id = $post['id_module'];
            unset($post['id_module']);
            // Так как у нас модули наследуются, то обновить тип модуля (name_system) не получится (настройки у модулей разные)
            // нужно пересоздать модуль
            
            if (isset($post['name_system']))
            {
                unset($post['name_system']);
            }
            
            // Во избежание автоматического случайного обновления системного имени модуля
            // мы системное имя заново получаем из БД. Оно нужно нам, для формирование правильного пути к модулю
            $arr = $this->M_admin_modules->getModuleById($id);
            
            if(isset($post['name']))
            {
                $updateGeneralData['name'] = $post['name'];
                unset($post['name']);
            }
            
            if(isset($post['description']))
            {
                $updateGeneralData['description'] = $post['description'];
                unset($post['description']);
            }            
             
            if(isset($post['id_position']))
            {
                $updateGeneralData['id_position'] = $post['id_position'];
                unset($post['id_position']);
            } 
             
            if (isset($post['is_active']))
            {
                $updateGeneralData['is_active'] = true;
                unset($post['is_active']);
            }
            else
            {
                $updateGeneralData['is_active'] = false;
            }  

            // Обновляем общие данные (эти данные есть у каждого модуля)
            $this->M_admin_modules->updateGeneralDataModuleById($id, $updateGeneralData);
            
            $dataArr = $post;  
            $dataArr['id_module'] = $id;
            $dataArr['name_system'] = $arr['name_system'];
            $dataArr['action'] = DEFAULT_ACTION_MODULE_FORM_UPDATE;
            Core::app()->getTemplate()->moduleContentView($dataArr, true);

            $url = Core::app()->getHtml()->createUrl('admin/modules');
            Core::app()->getRequest()->redirect($url, true, 302);
        }
    }

    public function edite()
    {
        $post = Core::app()->getRequest()->getPost();

        if (!$this->isEmpty($post))
        {
            $this->loadModel('M_admin_modules', $this->getNameModule());
            $this->loadModel('M_admin_position', $this->getNameModule());

            $dataArr = $this->M_admin_modules->getModuleById($post['id_module']);
            //Core::app()->echoPre($dataArr);
            $dataArr['form_action'] = 'admin/modules/update/';
            $dataArr['all_positions'] = $this->M_admin_position->getAllPositions();
            $dataArr['all_modules'] = $this->M_admin_modules->getAllModules();
            $dataArr['path'] = '';
            $dataArr['name_module'] = 'admin'; //Понадобится в модуле moduleFileContentView для отображения mod_admin_module_create.php
            $dataArr['file_content_view'] = 'mod_admin_module_create.php';
            $dataArr['return'] = true;
            
            // Получение стандартных для всех модулей  полей формы редактирования
            $content = Core::app()->getTemplate()->moduleContentView($dataArr);
            
            // Получаем индивидуальные поля настройки модуля. За эти поля отвечает определенный (обязательный) в константе DEFAULT_ACTION_MODULE_FORM
            // метод главного контроллера в каждом модуле. Таким образом мы на автомате можем формировать индивидуальные настройки каждого модуля
            $dataArr['action'] = DEFAULT_ACTION_MODULE_FORM;
            $content .= Core::app()->getTemplate()->moduleContentView($dataArr, true);

            $dataArr['content'] = $content;

            $content = Core::app()->getTemplate()->getWidget('form', $dataArr, null);

            Core::app()->getTemplate()->setVar('title_page', 'Редактирование модуля');
            Core::app()->getTemplate()->setVar('content', $content);
        }
    }

    public function delete()
    {
        $post = Core::app()->getRequest()->getPost();

        if (!$this->isEmpty($post))
        {
            $this->loadModel('M_admin_modules', $this->getNameModule());

            $dataArr = $this->M_admin_modules->getModuleById($post['id_module']);
            $dataArr['return'] = false;
            $dataArr['action'] = DEFAULT_ACTION_MODULE_FORM_DELETE;
            
            // Удаляем модуль из общей таблицы
            $this->M_admin_modules->deleteModuleById($post['id_module']);
            // Удаляем модуль из его собственных таблиц (у модуля есть собственный метод по удалению самого себя из БД)
            Core::app()->getTemplate()->moduleContentView($dataArr, true);

            
            $url = Core::app()->getHtml()->createUrl('admin/modules');
            Core::app()->getRequest()->redirect($url, true, 302);
        }
    }

    private function getUniqBySysNameModuleList($dataArr)
    {
        $arr = array();
        $add = true;

        for ($i = 0; $i < count($dataArr); $i++)
        {
            foreach ($dataArr[$i] as $key => $value)
            {
                if ($key == 'name_system')
                {// Проверяем если $value в уникальном масиве. Если есть, то проверяем следующее
                    for ($y = 0; $y < count($arr); $y++)
                    {
                        foreach ($arr[$y] as $keyArr => $valueArr)
                        {
                            if ($keyArr == 'name_system')
                            {
                                if ($value == $valueArr)
                                {
                                    $add = false;
                                }
                                break;
                            }
                        }
                        if (!$add)
                        {
                            break;
                        }
                    }
                    break;
                }
            }
            if ($add)
            {
                $arr[] = $dataArr[$i];
            }
            else
            {
                $add = true;
            }
        }



        return $arr;
    }

    public function getModuleFormFildsConfig($dataArr = null)
    {
        return 'C_admin_modules';
    }

    public function updateModuleFormFildsConfig($dataArr = null)
    {
        
    }
   
    public function deleteModuleDataById($id)
    {

    }
}

?>