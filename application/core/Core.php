<?php

class Core
{

    private static $_instance = null;
    private $_config; // Объект класса Config
    private $_error; // Объект класса Error   
    private $_secure; // Объект класса Secure   
    private $_grammatical; // Объект класса Grammatical   
    private $_request; // Объект класса Request    
    private $_route; // Объект класса Route    333

    private function __construct()
    {
        
    }

    public function __destruct()
    {
        
    }

    private function __clone()
    {
        
    }

    // Создаем нужные объекты при первом запуске, запускается только один раз
    // Все системные класы доступны из главного  класса
    // сделано для удобства пользования.
    // Принцип: все и всё общается через один класс
    private function init()
    {
        
    }

    // геттеры
    public function getError()
    {
        if (is_null(self::app()->_error))
        {
            self::app()->_error = new Error;
        }
        return self::app()->_error;
    }

    public function getSecure()
    {
        if (is_null(self::app()->_secure))
        {
            self::app()->_secure = new Secure;
        }
        return self::app()->_secure;
    }

    public function getConfig()
    {
        if (is_null(self::app()->_config))
        {
            self::app()->_config = new Config;
        }
        return self::app()->_config;
    }

    public function getGrammatical()
    {
        if (is_null(self::app()->_grammatical))
        {
            self::app()->_grammatical = new Grammatical;
        }
        return self::app()->_grammatical;
    }

    public function getRequest()
    {
        if (is_null(self::app()->_request))
        {
            self::app()->_request = new Request;
        }
        return self::app()->_request;
    }

    public function getRoute()
    {
        if (is_null(self::app()->_route))
        {
            self::app()->_route = new Route;
        }
        return self::app()->_route;
    }

    // Доступ к главному класу (сделан как singleton))
    public static function app()
    {
        if (is_null(self::$_instance))
        {
            self::$_instance = new self;
            self::app()->init();
        }

        return self::$_instance;
    }

    /**
     * 
     * @param key
     * @param object
     */
    public function echoEcho($str = "test")
    {
        echo $str . '<br/>';
    }

    /**
     * Выводит масив
     * 
     * @param arr
     */
    public function echoPre($arr)
    {
        echo '<pre>';
        print_r($arr);
        echo '</pre>';
    }

    public function appExit($str = '')
    {
        die($str);
    }

}

?>