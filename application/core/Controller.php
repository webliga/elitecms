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
    public function loadModel($model, $module_name = null)
    {
        if (is_null($module_name))
        {
            $_module_name = '';
        }
        else
        {
            $_module_name = SEPARATOR . $module_name;
        }

        $model_path = PATH_SITE_ROOT . SEPARATOR . PATH_TO_MODULES . $_module_name . SEPARATOR . NAME_FOLDER_MODULES_MODELS . SEPARATOR . $model . '.php';

        if (file_exists($model_path))
        {
            require_once $model_path;

            $nameModel = $model;
            $this->$nameModel = new $model;
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
    
    // Получаем поля формы для настройки модуля. Индивидуально для каждого модуля, реализуется в каждом модуле
    abstract public function getModuleFormFildsConfig($dataArr = null);
    
    abstract public function updateModuleFormFildsConfig($dataArr);
    
    abstract public function deleteModuleDataById($id);
}

?>