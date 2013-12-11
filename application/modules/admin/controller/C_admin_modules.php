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

        Core::app()->getTemplate()->setVar('dublicatePath', 'modules/createdublicate');
        Core::app()->getTemplate()->setVar('dublicateTitle', 'Создать дубликат модуля');    
        Core::app()->getTemplate()->setVar('createPath', 'modules/create');
        Core::app()->getTemplate()->setVar('createTitle', 'Создать нового модуля');         
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
            
            $this->loadModel('modules', $this->getNameModule());

            Core::app()->getTemplate()->setVar('title_page', 'Список модулей');

            $dataArr = $this->M_admin_modules->getAllModules();

//$this->echoPre($dataArr);

            for ($i = 0; $i < count($dataArr); $i++)
            {
                unset($dataArr[$i]['id_position']);
                unset($dataArr[$i]['is_active']);
                unset($dataArr[$i]['name_system_position']);
            }


            $dataArr['link_edite'] = 'modules/edite/';
            $dataArr['link_delete'] = 'modules/delete/';

            $content = Core::app()->getTemplate()->getWidget('data_table', $dataArr);
//$this->echoPre($content);
            Core::app()->getTemplate()->setVar('content', $content);
        }
    }
    
    // Загружаем этот метод только для вывода в позиции модуля
    public function showDataByPosition($dataArr = null)
    {

    }
    
    public function create()
    {
        Core::app()->getTemplate()->setVar('content', 'создание нового модуля' );
    }
    
    public function createdublicate()
    {
        $post = Core::app()->getRequest()->getPost();
        $this->loadModel('modules', $this->getNameModule());

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
            $this->loadModel('position', $this->getNameModule());

            $dataArr = array();
            $dataArr['id_position'] = 0;
            $dataArr['form_action'] = 'admin/modules/createdublicate/';
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

            Core::app()->getTemplate()->setVar('title_page', 'Создание дубликата модуля');
            Core::app()->getTemplate()->setVar('content', $content);
        }
    }

    public function update()
    {
        $post = Core::app()->getRequest()->getPost();

        if (!$this->isEmpty($post))
        {
            $this->loadModel('modules', $this->getNameModule());
//Core::app()->echoPre($post);
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

            if (isset($post['name']))
            {
                $updateGeneralData['name'] = $post['name'];
                unset($post['name']);
            }

            if (isset($post['description']))
            {
                $updateGeneralData['description'] = $post['description'];
                unset($post['description']);
            }

            if (isset($post['id_position']))
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

            // Обновляем общие данные (эти данные есть у каждого модуля)unset($dataArr['name_controller']);  
            $this->M_admin_modules->updateGeneralDataModuleById($id, $updateGeneralData);
            
            $dataArr = $post;
            $dataArr['id_module'] = $id;
            $dataArr['name_system'] = $arr['name_system']; // Для формирования пути к файлу модуля
            $dataArr['action'] = DEFAULT_ACTION_MODULE_FORM_UPDATE;
            Core::app()->getTemplate()->moduleContentView($dataArr, true);

            $url = Core::app()->getHtml()->createUrl('admin/modules');
            Core::app()->getRequest()->redirect($url, true, 302);
        }
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
        
        if ($id > 0)
        {
            $this->loadModel('modules', $this->getNameModule());
            $this->loadModel('position', $this->getNameModule());

            $dataArr = $this->M_admin_modules->getModuleById($id);
            //Core::app()->echoPre($dataArr);
            $dataArr['form_action'] = 'admin/modules/update/';
            $dataArr['all_positions'] = $this->M_admin_position->getAllPositions();
            $dataArr['all_modules'] = $this->M_admin_modules->getAllModules();
            $dataArr['path'] = '';
            
            $dataArr['name_module'] = 'admin'; //Понадобится в модуле moduleFileContentView для отображения mod_admin_module_create.php
            $dataArr['file_content_view'] = 'mod_admin_module_create.php';
            $dataArr['return'] = true;

            
            // Получение стандартных для всех модулей  полей формы редактирования
            $tabContent['tab_title'] = 'Общие настройки';
            $tabContent['tab_content'] = Core::app()->getTemplate()->moduleContentView($dataArr);
            
            $dataArr['tabs'][] = $tabContent;
            // Получаем индивидуальные поля настройки модуля. За эти поля отвечает определенный (обязательный) в константе DEFAULT_ACTION_MODULE_FORM
            // метод главного контроллера в каждом модуле. Таким образом мы на автомате можем формировать индивидуальные настройки каждого модуля
            $dataArr['action'] = DEFAULT_ACTION_MODULE_FORM;
            
            
            $moduleTabArr = Core::app()->getTemplate()->moduleContentView($dataArr, true);
            
            for ($i = 0; $i < count($moduleTabArr); $i++)
            {
                $dataArr['tabs'][] = $moduleTabArr[$i];
            }
            
//$this->echoPre($dataArr, false, true);
            // Формируем табы с настройками модуля            
            $dataArr['name_module'] = 'admin'; //Понадобится в модуле moduleFileContentView для отображения mod_admin_module_create.php
            $dataArr['file_content_view'] = 'mod_admin_module_tabs.php';
            $dataArr['return'] = true;
            $content = Core::app()->getTemplate()->moduleContentView($dataArr);
            
            $dataArr['content'] = $content;

            $content = Core::app()->getTemplate()->getWidget('form', $dataArr, null);

            Core::app()->getTemplate()->setVar('title_page', 'Редактирование модуля');
            Core::app()->getTemplate()->setVar('content', $content);
        }
    }

    public function delete()
    {
        $get = Core::app()->getRequest()->getGet();

        if (!$this->isEmpty($get))
        {
            $this->loadModel('modules', $this->getNameModule());

            $dataArr = $this->M_admin_modules->getModuleById($get['id']);
            $dataArr['return'] = false;
            $dataArr['action'] = DEFAULT_ACTION_MODULE_FORM_DELETE;

            // Удаляем модуль из общей таблицы
            $this->M_admin_modules->deleteModuleById($get['id']);
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