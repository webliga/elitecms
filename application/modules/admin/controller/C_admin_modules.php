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
    }

    function __destruct()
    {
        
    }

    /**
     * Действие по умолчанию
     */
    public function index()
    {
        //Core::app()->echoPre(Core::app()->getRequest()->getPost());
        $post = Core::app()->getRequest()->getPost();

        if (!$this->isEmpty($post))
        {
            echo 'good';
        }
        else
        {
            $this->loadModel('M_admin_modules', $this->getNameModule());

            Core::app()->getTemplate()->setVar('title_page', 'Главная страница');

            $dataArr = $this->M_admin_modules->getAllModules();
            $dataArr['thead'] = 'Список модулей';

            $content = Core::app()->getTemplate()->getWidget('listview_table', $dataArr, null);

            Core::app()->getTemplate()->setVar('content', $content);
        }
    }

    public function setting()
    {
        $post = Core::app()->getRequest()->getPost();
        
        if (!$this->isEmpty($post))
        {
            $this->loadModel('M_admin_modules', $this->getNameModule());

            $dataArr = $this->M_admin_modules->getModuleById($post['id_module']);
            //Core::app()->echoPre($dataArr);
//moduleContentView($path, $nameModule, $dataArr, $fileContentView)
            $content = Core::app()->getTemplate()->moduleContentView(null, 'admin', $dataArr, 'mod_admin_module_create.php', true);

            Core::app()->getTemplate()->setVar('content', $content);
        }
    }
    
    public function create()
    {

        Core::app()->getTemplate()->setVar('title_page', 'Страница создания новости. Отображается форма редактирования');
    }

    public function write()
    {
        $this->loadModel('M_main', $this->getNameModule());
        $this->loadModel('M_shop', $this->getNameModule());

        Core::app()->echoEcho('Страница записи новости. Отображается форма записи');
        //Core::app()->echoEcho('_name_model = ' . $this->mainM_shop->_name_model);
        //Core::app()->echoPre(Core::app()->getConfig()->getDataArrayConfig());
    }

    public function edite()
    {
        $this->loadModel('M_main', $this->getNameModule());
        $this->loadModel('M_shop', $this->getNameModule());

        Core::app()->echoEcho('Страница редактирования новости. Отображается форма редактирования');
        //Core::app()->echoEcho('_name_model = ' . $this->mainM_shop->_name_model);
        //Core::app()->echoPre(Core::app()->getConfig()->getDataArrayConfig());
    }

}

?>