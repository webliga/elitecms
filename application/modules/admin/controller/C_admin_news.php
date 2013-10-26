<?php

/**
 * Главный клас модуля, все запросы по умолчанию отправляются сюда
 * @author Веталь
 * @version 1.0
 * @updated 17-Вер-2013 20:15:13
 */
class C_admin_news extends Controller
{

    function __construct()
    {
        parent::__construct();

        $this->init();

        $this->loadModule('C_news_main', 'news', true);
    }

    function __destruct()
    {
        
    }

    /**
     * Действие по умолчанию
     */
    public function index($dataArr = NULL)
    {
        $this->C_news_main->index($dataArr);

    }

    public function create()
    {
        $this->C_news_main->create();
    }

    public function update()
    {
        $this->C_news_main->update();
    }

    public function edite()
    {
        $this->C_news_main->edite();
    }

    public function delete()
    {
        $this->C_news_main->delete();
    }

    public function getModuleFormFildsConfig($dataArr = null)
    {
        return 'C_news_main';
    }

    public function updateModuleFormFildsConfig($dataArr = null)
    {
        
    }
      
    public function deleteModuleDataById($id)
    {

    }
}

?>