<?php

/**
 * Главный клас модуля, все запросы по умолчанию отправляются сюда
 * @author Веталь
 * @version 1.0
 * @updated 17-Вер-2013 20:15:13
 */
class C_admin_menuitems extends Controller
{

    function __construct()
    {
        parent::__construct();

        $this->init();

        Core::app()->getTemplate()->setVar('createPath', 'menuitems/create');
        
        $this->loadModule('C_menu_menuitems', 'menu', true);
    }

    function __destruct()
    {
        
    }

    /**
     * Действие по умолчанию
     */
    public function index($dataArr = NULL)
    {
        $this->C_menu_menuitems->index($dataArr);

    }

    public function create()
    {
        $this->C_menu_menuitems->create();
    }

    public function update()
    {
        $this->C_menu_menuitems->update();
    }

    public function edite()
    {
        $this->C_menu_menuitems->edite();
    }

    public function delete()
    {
        $this->C_menu_menuitems->delete();
    }

    public function getModuleFormFildsConfig($dataArr = null)
    {
        return 'C_admin_menuitems';
    }

    public function updateModuleFormFildsConfig($dataArr = null)
    {
        
    }
      
    public function deleteModuleDataById($id)
    {

    }
}

?>