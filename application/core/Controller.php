<?php

/**
 * Главный класс для всех контроллеров
 * @author Веталь
 * @version 1.0
 * @updated 17-Вер-2013 23:02:27 
 */
abstract class Controller extends Base
{

    protected $_name_module;

    /**
     * работает с пост и гет данными
     */
    function __construct()
    {
        parent::__construct();
    }

    function __destruct()
    {
        
    }

    protected function init()
    {
        Core::app()->getTemplate()->setVar('createPath', '');
        Core::app()->getTemplate()->setVar('content', '');
        Core::app()->getTemplate()->setVar('title_page', '');
    }

    public function loadController($controllerName, $module_name)
    {
        $controller_path = '';
        $className =
                PFX_CONTROLLER .
                $module_name .
                S_MODULE_NAME .
                $controllerName;
        
        $controller_path = 
                PATH_SITE_ROOT . 
                SD . 
                PATH_TO_MODULES . 
                $module_name . 
                SD . 
                NAME_FOLDER_MODULES_CONTROLLERS . 
                SD . 
                $className . '.php';


        if (file_exists($controller_path))
        {
            require_once $controller_path;

            $this->$className = new $className;
        }
        else
        {
            $err['error'] = '!file_exists in Controller =  ' . $model_path;
            Core::app()->getTemplate()->showDanger($err);
        }
    }

    public function loadModel($modelName, $module_name)
    {
        $model_path = '';
        $className =
                PFX_MODEL .
                $module_name .
                S_MODULE_NAME .
                $modelName;

        $model_path =
                PATH_SITE_ROOT .
                SD .
                PATH_TO_MODULES .
                SD .
                $module_name .
                SD .
                NAME_FOLDER_MODULES_MODELS .
                SD .
                $className . '.php';

        if (file_exists($model_path))
        {
            require_once $model_path;

            $this->$className = new $className;
        }
        else
        {
            $err['error'] = '!file_exists in Controller =  ' . $model_path;
            Core::app()->getTemplate()->showDanger($err);
        }
    }

    public function setNameModule($name_module)
    {
        $this->_name_module = $name_module;
    }

    public function getNameModule($name_module = null)
    {
        if ($name_module == null)
        {
            return $this->_name_module;
        }
        else
        {
            return $name_module;
        }
    }

    //abstract public function getModuleElementsByCategoryId($id);

    abstract public function index($dataArr = null);

    abstract public function showDataByPosition($dataArr = null);

    // Получаем поля формы для настройки модуля. Индивидуально для каждого модуля, реализуется в каждом модуле
    abstract public function getModuleFormFildsConfig($dataArr = null);

    abstract public function updateModuleFormFildsConfig($dataArr);

    abstract public function deleteModuleDataById($id);
}

?>