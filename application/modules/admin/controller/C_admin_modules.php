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
        
    }

    public function create()
    {

        Core::app()->getTemplate()->setVar('title_page', 'Страница создания новости. Отображается форма редактирования');
    }

    public function update()
    {
        $post = Core::app()->getRequest()->getPost();

        if(!$this->isEmpty($post))
        {
            $this->loadModel('M_admin_modules', $this->getNameModule());
            
            $id = $post['id_module'];
            unset($post['id_module']);
            $this->M_admin_modules->updateModuleById($id, $post);
            
            Core::app()->echoPre($this->M_admin_modules->getAllModules());
        }
        
    }

    public function edite()
    {
        $post = Core::app()->getRequest()->getPost();

        if (!$this->isEmpty($post))
        {
            Core::app()->echoPre($post);


            $this->loadModel('M_admin_modules', $this->getNameModule());

            $dataArr = $this->M_admin_modules->getModuleById($post['id_module']);

//moduleContentView($path, $nameModule, $dataArr, $fileContentView)
            $content = Core::app()->getTemplate()->moduleContentView(null, 'admin', $dataArr, 'mod_admin_module_create.php', true);

            Core::app()->getTemplate()->setVar('content', $content);
        }
    }

}

?>