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
    private $_nameAdminTemplate = '';


    function __construct()
    {
        parent::__construct();
    }

    function __destruct()
    {
        
    }

    public function getCurrentTemplatePath($system = false)
    {
        // Если отображаем административный модуль  то $templateName = template_admin
        $templateName = $this->getCurrentTemplateName(Core::app()->getRequest()->getCallFromAdmin());

        $path = '';

        if (!$system)
        {
            $path = 
                    NAME_FOLDER_TEMPLATES . 
                    '/' . 
                    $templateName;
        }
        else
        {
            $path =
                    PATH_SITE_ROOT .
                    SD .
                    NAME_FOLDER_TEMPLATES .
                    SD .
                    $templateName;
        }

        return $path;
    }

    public function getCurrentTemplateName($admin = false)
    {
        if (!$admin)
        {
            return $this->_nameTemplate;
        }
        else
        {
            return $this->_nameAdminTemplate;
        }
    }

    public function setMainTemplateName($nameTemplate)
    {
        $this->_nameTemplate = $nameTemplate;
    }

    public function setAdminTemplateName($nameTemplate)
    {
        $this->_nameAdminTemplate = $nameTemplate;
    }

    public function showDanger($err, $nameFile = null, $inTemplate = false)
    {

        // Шаблоны виджетов можно переопределять в своем шаблоне
        // Достаточно в папку html/widgets  шаблона поместить файлы нужного виджета
        // и указать $inTemplate = true, метод будет искать уже в папке с текущим шаблоном

        if ($nameFile == null)
        {
            $nameFile = 'danger';
        }
        $path = '';

        if (!$inTemplate)
        {
            $path =
                    PATH_TO_DEFAULT_ERRORS .
                    SD .
                    $nameFile .
                    EXT_TEMPLATE_FILE;
        }
        else
        {
            $path =
                    $this->getCurrentTemplatePath(true) .
                    SD .
                    NAME_FOLDER_HTML .
                    SD .
                    NAME_FOLDER_ERROR .
                    SD .
                    $nameFile .
                    EXT_TEMPLATE_FILE;
        }

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
            Core::app()->getError()->errorFileNotExist('метод getRenderedHtml.  не существует $path = ' . $path);
        }

        return $content;
    }

    public function show($page = null)
    {
        // Тут можно изменить какие то конфигурационные данные
        // Или попозже реализовать систему хуков
        Core::app()->getLoader()->loadTemplate($page);
    }

    public function showBlock($nameBlock)
    {
        // Тут перед загрузкой блока можем реализовать какой то хук

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
                // Запускаем экшн, который выводит данные в позиции
                $modules[$i]['action'] = DEFAULT_ACTION_MODULE_SHOW_DATA_BY_POSITION;
                $this->moduleContentView($modules[$i], true);
            }
        }
    }

    public function moduleContentView($dataArr, $fromAction = false)
    {
        //Реализовать возможность вызова модуля из другого домена, по типу hmvc
        // также можно предварительно обработать входящие данные, например через систему хуков (еще не реализовано)
        // Отработать екш
        if ($fromAction)
        {
            return $this->moduleActionContentView($dataArr);
        }
        else
        {// Если нужно отработать какой-либо файл шаблона модуля
            return $this->moduleFileContentView($dataArr);
        }
    }

// Получаем данные модуля
    private function moduleActionContentView($module)
    {//Реализовать возможность вызова модуля из другого домена, по типу hmvc
        if (!isset($module['name_controller']) || $this->isEmpty($module['name_controller']))
        {
            $module['name_controller'] = 'main';
        }

        $path =
                PATH_SITE_ROOT .
                SD .
                PATH_TO_MODULES .
                SD .
                $module['name_system'] .
                SD .
                NAME_FOLDER_MODULES_CONTROLLERS .
                SD .
                PFX_CONTROLLER .
                $module['name_system'] .
                S_MODULE_NAME .
                $module['name_controller'] . EXT_TEMPLATE_FILE;


        if ($this->issetFile($path))
        {
            require_once $path;

            $className = PFX_CONTROLLER . $module['name_system'] . S_MODULE_NAME . $module['name_controller'];
            $mod = new $className;
            $mod->setNameModule($module['name_system']);

            if (isset($module['action']) && !$this->isEmpty($module['action']))
            {
                $action = $module['action'];
                unset($module['action']);
            }
            else
            {
                // Запускаем дефолтный экшн главного контроллера нашего модуля
                // В нем мы уже выводим нужные нам данные
                $action = DEFAULT_ACTION;
            }

            unset($module['name_system']);
            unset($module['name_controller']);

            if (isset($module['return']) && $module['return'])
            {
                $content = $mod->$action($module);

                return $content;
            }
            $mod->$action($module);
        }
        else
        {
            Core::app()->getError()->errorFileNotExist('Блок ' . $path . ' не существует!');
        }
    }

// Выводит результат работы модуля или возвращает в переменной результат работы
    private function moduleFileContentView($dataArr)
    {
        if (!isset($dataArr['path']) || $this->isEmpty($dataArr['path']))
        {
            $templateName = Core::app()->getTemplate()->getCurrentTemplatePath(true);

            $dataArr['path'] =
                    $templateName .
                    SD .
                    'modules' .
                    SD .
                    $dataArr['name_module'] . // Скорее всего нужно переименовать в name_system, что б небыло путаницы
                    SD .
                    $dataArr['file_content_view'];
        }

        if (isset($dataArr['return']) && $dataArr['return'])
        {
            $content = $this->getRenderedHtml($dataArr['path'], $dataArr, false);

            return $content;
        }

        if ($this->issetFile($dataArr['path']))
        {
            extract($dataArr);
            // Передаем данные в шаблон вывода
            require $dataArr['path'];
        }
        else
        {

            Core::app()->getError()->errorFileNotExist('Шаблона   ' . $dataArr['path'] . ' не существует!');
        }
    }

    public function getWidget($nameWidget, $dataArr, $inTemplate = false)
    {
        //$dataArr обработка этого масива идет в подключенном файле
        // Шаблоны виджетов можно переопределять в своем шаблоне
        // Достаточно в папку html/widgets  шаблона поместить файлы нужного виджета
        // и указать $inTemplate = true, метод будет искать уже в папке с текущим шаблоном

        $content = '';

        $path = '';

        if (!$inTemplate)
        {
            $path =
                    PATH_TO_DEFAULT_WIDGETS .
                    SD .
                    $nameWidget .
                    EXT_TEMPLATE_FILE;
        }
        else
        {
            $path =
                    $this->getCurrentTemplatePath(true) .
                    SD .
                    NAME_FOLDER_HTML .
                    SD .
                    NAME_FOLDER_WIDGETS .
                    SD .
                    $nameWidget . EXT_TEMPLATE_FILE;
        }

        $content = $this->getRenderedHtml($path, $dataArr, false);

        return $content;
    }

}

?>