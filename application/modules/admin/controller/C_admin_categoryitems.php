<?php

/**
 * Главный клас модуля, все запросы по умолчанию отправляются сюда
 * @author Веталь
 * @version 1.0
 * @updated 17-Вер-2013 20:15:13
 */
class C_admin_categoryitems extends Controller
{

    function __construct()
    {
        parent::__construct();

        $this->init();
        
        $this->loadModule('C_category_categoryitems', 'category', true);
    }

    function __destruct()
    {
        
    }

    /**
     * Действие по умолчанию
     */
    public function index($dataArr = NULL)
    {
        $this->C_category_categoryitems->index($dataArr);
    }
    
    
    // Загружаем этот метод только для вывода в позиции модуля
    public function showDataByPosition($dataArr = null)
    {

    }
    
    public function create()
    {
        $this->C_category_categoryitems->create();
    }

    public function update()
    {
        $this->C_category_categoryitems->update();
    }

    public function edite()
    {
        $this->C_category_categoryitems->edite();
    }

    public function delete()
    {
        $this->C_category_categoryitems->delete();
    }

    public function getModuleFormFildsConfig($dataArr = null)
    {
        
    }

    private function getDefaultMenuItemData($dataArr)
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