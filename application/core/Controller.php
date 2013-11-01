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

//создание модели
    public function loadModule($className, $module_name = null, $isController = false)
    {
        $model_path = '';
        
        if ($this->isEmpty($module_name) || is_null($module_name))
        {
            $_module_name = '';
        }
        else
        {
            $_module_name = SD . $module_name;
        }

        if($isController)
        {
            $model_path = PATH_SITE_ROOT . SD . PATH_TO_MODULES . $_module_name . SD . NAME_FOLDER_MODULES_CONTROLLERS . SD . $className . '.php';
        }
        else
        {
            $model_path = PATH_SITE_ROOT . SD . PATH_TO_MODULES . $_module_name . SD . NAME_FOLDER_MODULES_MODELS . SD . $className . '.php';
        }

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

    abstract public function index($dataArr = null);
    
    abstract public function showDataByPosition($dataArr = null);
    
    // Получаем поля формы для настройки модуля. Индивидуально для каждого модуля, реализуется в каждом модуле
    abstract public function getModuleFormFildsConfig($dataArr = null);

    abstract public function updateModuleFormFildsConfig($dataArr);

    abstract public function deleteModuleDataById($id);
}

?>