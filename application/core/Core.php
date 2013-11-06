<?php

class Core extends Base
{

    private static $_instance = null;
    private $_config; // Объект класса Config
    private $_error; // Объект класса Error   
    private $_secure; // Объект класса Secure   
    private $_grammatical; // Объект класса Grammatical   
    private $_request; // Объект класса Request    
    private $_route; // Объект класса Route    
    private $_user;
    private $_loader;
    private $_template;
    private $_html;


    public function __construct()
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
            $class = self::app()->getClassNameForCreate('error');
            self::app()->_error = new $class;
        }
        return self::app()->_error;
    }

    public function getSecure()
    {
        if (is_null(self::app()->_secure))
        {
            $class = self::app()->getClassNameForCreate('secure');
            self::app()->_secure = new $class;
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
            $class = self::app()->getClassNameForCreate('grammatical');
            self::app()->_grammatical = new $class;
        }
        return self::app()->_grammatical;
    }

    public function getRequest()
    {
        if (is_null(self::app()->_request))
        {
            $class = self::app()->getClassNameForCreate('request');
            self::app()->_request = new $class;
        }
        return self::app()->_request;
    }

    public function getRoute()
    {
        if (is_null(self::app()->_route))
        {
            $class = self::app()->getClassNameForCreate('route');
            self::app()->_route = new $class;
        }
        return self::app()->_route;
    }

    public function getUser()
    {
        if (is_null(self::app()->_user))
        {      
            $class = self::app()->getClassNameForCreate('user');

            self::app()->_user = new $class;
        }

        return self::app()->_user;
    }

    public function getLoader()
    {
        if (is_null(self::app()->_loader))
        {
            self::app()->_loader = new Loader;
        }

        return self::app()->_loader;
    }

    public function getTemplate()
    {
        if (is_null(self::app()->_template))
        {
            $class = self::app()->getClassNameForCreate('template');

            self::app()->_template = new $class;
        }

        return self::app()->_template;
    }
 
    public function getHtml()
    {
        if (is_null(self::app()->_html))
        {
            $class = self::app()->getClassNameForCreate('html');

            self::app()->_html = new $class;
        }

        return self::app()->_html;
    }   
    
        
// Вытягиваем класс из дефолтных настроек 
// (Дефолтный класс можно переопределить                                                           
// в любом модуле и прописать путь к нему) 
    public function getClassNameForCreate($class)
    {
        $configClassUser = self::app()->getConfig()->getConfigItem('default_classes');
        $className = $configClassUser[$class]['name'];
        $pathToClass = $configClassUser[$class]['path'];
        
        
        $pathToClassUser =
                PATH_SITE_ROOT . 
                SD . 
                $pathToClass .
                SD .
                $className . '.php';

        self::app()->getLoader()->loadFile($pathToClassUser);

        return $className;
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


    public function appExit($str = '')
    {
        die($str);
    }

}

?>