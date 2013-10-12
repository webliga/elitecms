<?php

/**
 * Класс который отвечает за запросы
 * @author Веталь
 * @version 1.0
 * @updated 17-Вер-2013 20:15:13
 */
class Request extends Base
{

    private $_lang;
    private $_module;
    private $_controller;
    private $_action;
    private $_params;
    private $_url;
    private $_post;
    private $_get;
    private $_host;

    function __construct()
    {
        $this->_host = 'http://' . $_SERVER['HTTP_HOST'];
    }

    function __destruct()
    {
        
    }

    public function getPost($key = null)
    {
        if ($key != null && is_array($_post))
        {
            return $this->_post[$key];
        }

        return $this->_post;
    }

    public function getGet($key = null)
    {
        if ($key != null && is_array($_get))
        {
            return $this->_get[$key];
        }

        return $this->_get;
    }

    public function setPostGet()
    {
        if (isset($_POST))
        {// Можно проверку сделать
            $this->_post = $_POST;
            $_POST = null;
        }

        if (isset($_GET))
        {// Можно проверку сделать
            $this->_get = $_GET;
            $_GET = null;
        }
    }

    /**
     * Обязательно переделать этот метод, нет нормального разбора урл
     */
    public function runParseUrl($url)
    {
        $configDefaultUrl = Core::app()->getConfig()->getConfigItem('default_module');
        $configDefaultLang = Core::app()->getConfig()->getConfigItem('default_lang');

        //Core::app()->echoPre($configDefaultUrl);
        // Ставим путь по умолчанию
        $this->_url = $url;
        $this->_lang = $configDefaultLang['name'];
        $this->_module = $configDefaultUrl['name'];
        $this->_controller = $configDefaultUrl['controller'];
        $this->_action = $configDefaultUrl['action'];


        $routes = explode('/', $url);

        // lang
        if (isset($routes[1]) && strlen($routes[1]) < 3 && count($routes) >= 4)
        {
            $this->_lang = $routes[1];
        }
        else
        {
            //Core::app()->getError()->errorPage404('5');
            return;
        }
        // module
        if (isset($routes[2]))
        {
            $this->_module = $routes[2];
        }
        // controller
        if (isset($routes[3]))
        {
            $this->_controller = $routes[3];
        }
        // action       
        if (isset($routes[4]) && strlen($routes[4]) > 0)
        {
            $this->_action = $routes[4];
        }
        else
        {
            $this->_action = DEFAULT_ACTION;
        }
    }

    public function getLang($lang = null)
    {// Проверка на существование папки с языком
        if ($lang != null)
        {
            return $lang;
        }
        else
        {
            return $this->_lang;
        }
    }

    public function getModule()
    {
        return $this->_module;
    }

    public function getController()
    {
        return $this->_controller;
    }

    public function getAction()
    {
        return $this->_action;
    }

    public function getParams()
    {
        return $this->_params;
    }

    public function getUrl()
    {
        return $this->_url;
    }

    public function redirect($url, $terminate = true, $statusCode = 302)
    {
        $url = $this->_host . $url;
        
        header('Location: ' . $url, true, $statusCode);
        if ($terminate)
            Core::app()->appExit();
    }

}

?>