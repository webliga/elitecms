<?php

/**
 * Главный клас модуля, все запросы по умолчанию отправляются сюда
 * @author Веталь
 * @version 1.0
 * @updated 17-Вер-2013 20:15:13
 */
class C_admin_newsitems extends Controller
{

    function __construct()
    {
        parent::__construct();

        $this->init();

        $this->loadModule('C_news_newsitems', 'news', true);
    }

    function __destruct()
    {
        
    }

    /**
     * Действие по умолчанию
     */
    public function index($dataArr = NULL)
    {
        return $this->C_news_newsitems->index($dataArr);

    }

    // Загружаем этот метод только для вывода в позиции модуля
    public function showDataByPosition($dataArr = null)
    {

    }
    
    public function create()
    {
        //$this->C_news_newsitems->create();
    }

    public function update()
    {
        $this->C_news_newsitems->update();
    }

    public function edite()
    {
        $this->C_news_newsitems->edite();
    }

    public function delete()
    {
        $this->C_news_newsitems->delete();
    }

    public function getModuleFormFildsConfig($dataArr = null)
    {
        return 'C_admin_newsitems';
    }

    public function updateModuleFormFildsConfig($dataArr = null)
    {
        
    }
      
    public function deleteModuleDataById($id)
    {

    }
}

?>