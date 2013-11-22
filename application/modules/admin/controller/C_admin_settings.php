<?php

/**
 * Главный клас модуля, все запросы по умолчанию отправляются сюда
 * @author Веталь
 * @version 1.0
 * @updated 17-Вер-2013 20:15:13
 */
class C_admin_settings extends Controller
{

    function __construct()
    {
        parent::__construct();

        $this->init();

        Core::app()->getTemplate()->setVar('createPath', 'settings/create');
        Core::app()->getTemplate()->setVar('createTitle', 'Создать настройку');
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


            $this->loadModel('settings', $this->getNameModule());

            Core::app()->getTemplate()->setVar('title_page', 'Список настроек');

            $dataArr = $this->M_admin_settings->getAllSettings();

            $dataArr['form_action'] = 'admin/settings/update/';
            $dataArr['lang'] = $this->loadLangFile('settings.php');
            $dataArr['path'] = ''; // абсолютный путь к файлу отображения, если пустой, то формируется дальше
            $dataArr['name_module'] = 'admin';
            $dataArr['file_content_view'] = 'mod_admin_settings.php';
            $dataArr['return'] = true; // возвратить результат работы в переменную, если false, то отображаем сразу
            $dataArr['create'] = true; // Если создание нового, то чекбокс "Активное" делаем неактивным, так как мы сразу не подгрузим нужные файлы для детальной настройки модуля

            $content = Core::app()->getTemplate()->moduleContentView($dataArr, false);

            $dataArr['content'] = $content;
            // переделать под createForm
            $content = Core::app()->getTemplate()->getWidget('form', $dataArr, null);
            Core::app()->getTemplate()->setVar('content', $content);
        }
    }

    public function loadLangFile($fileName, $lang = null)
    {
        if ($lang == null)
        {
            $lang = Core::app()->getRequest()->getLang();
        }

        $path_lang =
                PATH_SITE_ROOT .
                SD .
                PATH_TO_MODULES .
                SD .
                $this->getNameModule() .
                SD .
                'lang' .
                SD .
                $lang .
                SD .
                $fileName;

        return Core::app()->getLoader()->loadFile($path_lang, true);
    }

    // Загружаем этот метод только для вывода в позиции модуля
    public function showDataByPosition($dataArr = null)
    {
        
    }

    public function create()
    {
        $post = Core::app()->getRequest()->getPost();
        $this->loadModel('settings', $this->getNameModule());

        if (!$this->isEmpty($post))
        {
            $dataArr['name'] = $post['name'];
            $dataArr['value'] = $post['value'];

            $this->M_admin_settings->setSettings($dataArr);

            $url = Core::app()->getHtml()->createUrl('admin/modules');
            Core::app()->getRequest()->redirect($url, true, 302);
        }
        else
        {
            $dataArr = array();
            $dataArr['form_action'] = 'admin/settings/create/';
            $dataArr['lang'] = $this->loadLangFile('settings.php');
            $dataArr['path'] = ''; // абсолютный путь к файлу отображения, если пустой, то формируется дальше
            $dataArr['name_module'] = 'admin';
            $dataArr['file_content_view'] = 'mod_admin_settings_create.php';
            $dataArr['return'] = true; // возвратить результат работы в переменную, если false, то отображаем сразу
            $dataArr['create'] = true; // Если создание нового, то чекбокс "Активное" делаем неактивным, так как мы сразу не подгрузим нужные файлы для детальной настройки модуля

            $content = Core::app()->getTemplate()->moduleContentView($dataArr, false);

            $dataArr['content'] = $content;
            // переделать под createForm
            $content = Core::app()->getTemplate()->getWidget('form', $dataArr, null);

            Core::app()->getTemplate()->setVar('title_page', 'Создание настройки');
            Core::app()->getTemplate()->setVar('content', $content);
        }
    }

    public function update()
    {
        $post = Core::app()->getRequest()->getPost();

        if (!$this->isEmpty($post))
        {
            $this->loadModel('settings', $this->getNameModule());
            
            $dataArr = $post;
            
            if(isset($post['is_active']))
            {
                $dataArr['is_active'] = 1;
            }
            else
            {
                $dataArr['is_active'] = 0;
            }

            $this->M_admin_settings->updateSettings($dataArr);

            $url = Core::app()->getHtml()->createUrl('admin/settings');
            Core::app()->getRequest()->redirect($url, true, 302);
        }
    }

    public function edite()
    {

    }

    public function delete()
    {

    }

    

    public function getModuleFormFildsConfig($dataArr = null)
    {
        
    }

    public function updateModuleFormFildsConfig($dataArr = null)
    {
        
    }

    public function deleteModuleDataById($id)
    {
        
    }

}

?>