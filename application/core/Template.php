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

    public function getTemplatePath()
    {
        $path = '/templates/' . $this->_nameTemplate . '/';

        return $path;
    }

    public function setMainTemplateName($nameTemplate)
    {
        $this->_nameTemplate = $nameTemplate;
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

        if ($this->issetFile($path))
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

    public function getRenderedHtml($path, $dataArr, $once = false)
    {
        $content = '';

        if ($this->issetFile($path))
        {
            ob_start();

            if ($once)
            {
                require_once $path;
            }
            else
            {
                require $path;
            }

            $content = ob_get_contents();

            ob_end_clean();
        }
        else
        {
            Core::app()->getError()->errorFileNotExist('getRenderedHtml.  не существует $path = ' . $path);
        }

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
                $this->getModuleContent($modules[$i]);
            }
        }
    }

// Получаем данные модуля
    public function getModuleContent($module)
    {//Реализовать возможность вызова модуля из другого домена, по типу hmvc
        $path =
                PATH_SITE_ROOT .
                SEPARATOR .
                PATH_TO_MODULES .
                SEPARATOR .
                $module['name_system'] .
                SEPARATOR .
                NAME_FOLDER_MODULES_CONTROLLERS .
                SEPARATOR .
                PREFIX_CONTROLLER .
                $module['name_system'] . '_main.php';

        if ($this->issetFile($path))
        {
            require_once $path;

            $className = PREFIX_CONTROLLER . $module['name_system'] . '_main';
            $mod = new $className;
            $mod->setNameModule($module['name_system']);

            $action = DEFAULT_ACTION;
            
            
            // Запускаем дефолтный экшн главного контроллера нашего модуля
            // В нем мы уже выводим нужные нам данные 
            $mod->$action($module);
        }
        else
        {
            Core::app()->getError()->errorFileNotExist('Блок ' . $path . ' не существует!');
        }
    }

// Выводит результат работы модуля или возвращает в переменной результат работы
    public function moduleContentView($path, $nameModule, $dataArr, $fileContentView, $return = false)
    {
        if ($this->isEmpty($path))
        {
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
                    $fileContentView;
        }

        if ($return)
        {
            $content = $this->getRenderedHtml($path, $dataArr, false);

            return $content;
        }

        if ($this->issetFile($path))
        {
            extract($dataArr);
            // Передаем данные в шаблон вывода
            require $path;
        }
        else
        {
            Core::app()->getError()->errorFileNotExist('Шаблона для модуля  ' . $path . ' не существует!');
        }
    }

    public function getWidget($nameWidget, $dataArr, $path = null)
    {//$dataArr обработка этого масива идет в подключенном файле
        $content = '';

        if ($this->isEmpty($path))
        {
            $template = Core::app()->getConfig()->getConfigItem('default_template');

            Core::app()->getTemplate()->setMainTemplateName($template['name']);
            $path =
                    PATH_SITE_ROOT .
                    SEPARATOR .
                    $template['path'] .
                    SEPARATOR .
                    $template['name'] .
                    SEPARATOR .
                    'widgets' .
                    SEPARATOR .
                    $nameWidget . '.php';
        }

        $content = $this->getRenderedHtml($path, $dataArr, false);

        return $content;
    }

}

?>