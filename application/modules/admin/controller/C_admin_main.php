<?php

/**
 * Главный клас модуля, все запросы по умолчанию отправляются сюда
 * @author Веталь
 * @version 1.0
 * @updated 17-Вер-2013 20:15:13
 */
class C_admin_main extends Controller
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
    public function index($dataArr = NULL)
    {
        
        $this->loadModule('M_admin_main', $this->getNameModule());

        Core::app()->getTemplate()->setVar('title_page', 'Главная страница');

        Core::app()->getTemplate()->setVar('content', 'Это контент, который обрабатывается 
            контроллером с адресной строки. Сейчас находимся в админке');
    }

        
    // Загружаем этот метод только для вывода в позиции модуля
    public function showDataByPosition($dataArr = null)
    {

    }
    
    public function create()
    {

        Core::app()->getTemplate()->setVar('title_page', 'Страница создания новости. Отображается форма редактирования');
    }

    public function write()
    {
        $this->loadModule('M_main', $this->getNameModule());
        $this->loadModule('M_shop', $this->getNameModule());

        Core::app()->echoEcho('Страница записи новости. Отображается форма записи');
        //Core::app()->echoEcho('_name_model = ' . $this->mainM_shop->_name_model);
        //Core::app()->echoPre(Core::app()->getConfig()->getDataArrayConfig());
    }

    public function edite()
    {
        $this->loadModule('M_main', $this->getNameModule());
        $this->loadModule('M_shop', $this->getNameModule());

        Core::app()->echoEcho('Страница редактирования новости. Отображается форма редактирования');
        //Core::app()->echoEcho('_name_model = ' . $this->mainM_shop->_name_model);
        //Core::app()->echoPre(Core::app()->getConfig()->getDataArrayConfig());
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