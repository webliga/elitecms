<?php

/**
 * Это главный абстрактный клас от которого будут наследоваться все класы движка
 * @author Веталь
 * @version 1.0
 * @updated 18-Вер-2013 3:40:40
 */
abstract class Base
{

    function __construct()
    {
        
    }

    function __destruct()
    {
        
    }

    /**
     * Возвращает имя класа
     */
    public function getClassName()
    {
        return get_class($this);
    }

    public function loadController($controllerName, $module_name, $returnObjectController = false)
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


            if ($returnObjectController)
            {
                return new $className;
            }
            else
            {
                $this->$className = new $className;
            }
        }
        else
        {
            $err['error'] = '!file_exists in Controller =  ' . $model_path;
            Core::app()->getTemplate()->showDanger($err);
        }
    }

    public function loadModel($modelName, $module_name = null, $returnObjectModel = false)
    {
        if ($module_name == null)
        {
            $module_name = $this->_name_module;
        }

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

            if ($returnObjectModel)
            {
                return new $className;
            }
            else
            {
                $this->$className = new $className;
            }
        }
        else
        {
            $err['error'] = '!file_exists in Controller =  ' . $model_path;
            Core::app()->getTemplate()->showDanger($err);
        }
    }

    public function isEmpty($var)
    {
        $empty = true;

        if (isset($var) && $var != null && $var != '' && $var != ' ')
        {
            $empty = false;
        }

        return $empty;
    }

    public function issetFile($path)
    {
        if (file_exists($path) && is_file($path))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function echoEcho($str = "test")
    {
        echo $str . '<br/>';
    }

    /**
     * Выводит масив
     * 
     * @param arr
     */
    public function echoPre($dataArr, $return = false, $exit = false)
    {
        if (!$return)
        {
            echo '<pre>';
            print_r($dataArr, $return);
            echo '</pre>';
        }
        else
        {
            $data = '<pre>';
            $data .= print_r($dataArr, $return);
            $data .= '</pre>';
            return $data;
        }

        if ($exit)
        {
            $this->appExit();
        }
    }

    public function appExit($str = '')
    {
        die($str);
    }

}

?>