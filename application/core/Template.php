<?php

/**
 * Главный класс для всех контроллеров
 * @author Веталь
 * @version 1.0
 * @updated 17-Вер-2013 23:02:27
 */
class Template extends Base
{

    public $_data;
    private $_nameTemplate = '';

    function __construct()
    {
        parent::__construct();
    }

    function __destruct()
    {
        
    }

    public function showDanger($err)
    {
        $template = Core::app()->getConfig()->getConfigItem('default_template');

            $path =
                    PATH_SITE_ROOT .
                    SEPARATOR .
                    $template['path'] .
                    SEPARATOR .
                    $template['name'] .
                    SEPARATOR .
                    'error' .
                    SEPARATOR .
                    'danger.php';
            
            if (file_exists($path))
            {
                extract($err);
                // Передаем данные в шаблон вывода
                require $path;
            }
            
            
    }

    public function setVar($nameVar, $dataVar)
    {
        $this->_data[$nameVar] = $dataVar;
    }

    public function getRenderedHtml($pathToTemplate, $data)
    {
        $content = '';

        return $content;
    }

    public function show()
    {
        Core::app()->getLoader()->loadTemplate();
    }

    public function showBlock($nameBlock)
    {
        Core::app()->getLoader()->loadTemplateBlock($nameBlock);
    }

//Вызывается из кода шаблонов
//Вставляет результат работы модулей, привязанных к данной позиции.
    public function getModulesByPosition($nameModulePosition)
    {
        //Core::app()->echoPre(Core::app()->getConfig()->getConfigItem('modules'));

        $modules = Core::app()->getConfig()->getConfigItem('modules');

        for ($i = 0; $i < count($modules); $i++)
        {
            if ($modules[$i]['position_name_system'] == $nameModulePosition)
            {
                $data = array('id_menu' => $modules[$i]['module_id']);


                $this->getModuleContent($modules[$i]['name_system'], $modules[$i]['template_file'], $data);
            }
        }
    }

    public function getModuleContent($nameModule, $pathContentView, $data)
    {//Реализовать возможность вызова модуля из другого домена, по типу hmvc
        $path =
                PATH_SITE_ROOT .
                SEPARATOR .
                PATH_TO_MODULES .
                SEPARATOR .
                $nameModule .
                SEPARATOR .
                NAME_FOLDER_MODULES_CONTROLLERS .
                SEPARATOR .
                PREFIX_CONTROLLER .
                $nameModule . '_main.php';

        if (file_exists($path))
        {
            require_once $path;

            $className = PREFIX_CONTROLLER . $nameModule . '_main';
            $mod = new $className;
            $mod->setNameModule($nameModule);

            $action = DEFAULT_ACTION;
            $arrData = $mod->$action($data);

            $template = Core::app()->getConfig()->getConfigItem('default_template');

            $path =
                    PATH_SITE_ROOT .
                    SEPARATOR .
                    $template['path'] .
                    SEPARATOR .
                    $template['name'] .
                    SEPARATOR .
                    'modules' .
                    SEPARATOR .
                    $nameModule .
                    SEPARATOR .
                    $pathContentView;

            $menu_items['menu_items'] = $arrData;


            if (file_exists($path))
            {
                extract($menu_items);
                // Передаем данные в шаблон вывода
                require $path;
            }
        }
        else
        {
            Core::app()->getError()->errorFileNotExist('Блок ' . $path . ' не существует!');
        }
    }

}

?>