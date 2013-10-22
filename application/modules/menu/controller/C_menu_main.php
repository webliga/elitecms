<?php

/**
 * Главный клас модуля, все запросы по умолчанию отправляются сюда
 * @author Веталь
 * @version 1.0
 * @updated 17-Вер-2013 20:15:13
 */
class C_menu_main extends Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function __destruct()
    {
        
    }

    /**
     * Получаем стартовые данные для формирования меню
     */
    public function index($data = null)
    {
        if ($data != null)
        {
            $this->loadModule('M_menu_main', $this->getNameModule());

            $dataArr['menu_items'] = $this->M_menu_main->getMenuItemsByModuleId($data['id_module']);
            // Сделать сортировку масива пунктов меню по дочерним элементам
            
            
            
            
            $settings = $this->M_menu_main->getMenuSettingsByModuleId($data['id_module']);
            $dataArr['path'] = '';
            $dataArr['name_module'] = $this->getNameModule();
            $dataArr['file_content_view'] = $settings['template_file'];
            $dataArr['return'] = false;
            //$this->echoPre($dataArr);
            Core::app()->getTemplate()->moduleContentView($dataArr, false);
            // Выводим на экран содержимое файла нашего модуля
            //Core::app()->getTemplate()->moduleFileContentView(null, $this->getNameModule(), $menu_items, $settings['template_file']);
        }
    }

    public function create()
    {
        $this->loadModule('M_main', $this->getNameModule());
        $this->loadModule('M_shop', $this->getNameModule());

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

// Получаем индивидуальные поля для настройки модуля
    public function getModuleFormFildsConfig($dataArr = null)
    {
        if ($dataArr != null)
        {
            $this->loadModule('M_menu_main', $this->getNameModule());

            $dataArr = $this->M_menu_main->getMenuSettingsByModuleId($dataArr['id']);
            $dataArr['input'] = 'form_input';
            $dataArr['input_name'] = 'template_file'; 
            $dataArr['input_value'] = $dataArr['template_file'];            
            $dataArr['input_lable'] = 'Файл отображения';            
            
            $content = Core::app()->getHtml()->createInput($dataArr);

            return $content;
        }
    }

    public function updateModuleFormFildsConfig($dataArr)
    {
        $this->loadModule('M_menu_main', $this->getNameModule());

        $result = $this->M_menu_main->updateMenuSettingsByModuleId($dataArr);
    }

    public function deleteModuleDataById($dataArr)
    {
        $id = $dataArr['id'];
        $this->loadModule('M_menu_main', $this->getNameModule());
        $this->loadModule('M_menu_menuitems', $this->getNameModule());
        
        $result = $this->M_menu_main->deleteMenuSettingsByModuleId($id);
        $result = $this->M_menu_menuitems->deleteAllMenuItemsByModuleId($id);        
    }
}

?>