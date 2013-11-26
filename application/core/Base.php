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
        
        if($exit)
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