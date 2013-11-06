<?php

/**
 * Класс который отвечает за запросы
 * @author Веталь
 * @version 1.0
 * @updated 17-Вер-2013 20:15:13
 */
class Request extends Base
{

    private $_lang = null;
    private $_module = null;
    private $_controller = null;
    private $_action = null;
    private $_params = null;
    private $_url = null;
    private $_post = null;
    private $_get = null;
    private $_file;
    private $_host;
    private $_routeRuleArr;
    private $_callFromAdmin = false;

    function __construct()
    {
        $this->_host = 'http://' . $_SERVER['HTTP_HOST'];
    }

    function __destruct()
    {
        
    }

    public function getPost($key = null)
    {
        if ($key != null && is_array($this->_post))
        {
            return $this->_post[$key];
        }

        return $this->_post;
    }

    public function getGet($key = null)
    {
        if ($key != null && is_array($this->_get))
        {
            return $this->_get[$key];
        }

        return $this->_get;
    }

    public function getFile($key = null)
    {
        if ($key != null && is_array($this->_file))
        {
            return $this->_file[$key];
        }

        return $this->_get;
    }

    public function setGlobalVars()
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

        if (isset($_FILE))
        {// Можно проверку сделать
            $this->_file = $_FILE;
            $_FILE = null;
        }
    }

    /**
     * Обязательно переделать этот метод, нет нормального разбора урл
     */
    public function setRouteRule($routeRuleArr)
    {
        $this->_routeRuleArr = $routeRuleArr;
    }

    private function setCallFromAdmin($url)
    {
        $this->parse($url);

        if (!$this->isEmpty($this->_module))
        {
            $path_module_config =
                    PATH_SITE_ROOT .
                    SD .
                    PATH_TO_MODULES .
                    SD .
                    $this->_module .
                    SD .
                    NAME_FOLDER_MODULES_CONFIG .
                    SD .
                    PFX_CONFIG . 'main.php';

            $configModule = Core::app()->getLoader()->loadFile($path_module_config, true);

            if (isset($configModule['is_admin']) && $configModule['is_admin'])
            {
                $this->_callFromAdmin = $configModule['is_admin'];
            }
        }
    }

    public function runParseUrl($url)
    {
        $configDefaultUrl = Core::app()->getConfig()->getConfigItem('default_module');
        $configDefaultLang = Core::app()->getConfig()->getConfigItem('default_lang');


        // Ставим путь по умолчанию
        $this->_url = $url;
        $this->_lang = $configDefaultLang['name'];
        $this->_module = $configDefaultUrl['name'];
        $this->_controller = $configDefaultUrl['controller'];
        $this->_action = $configDefaultUrl['action'];

        $routes = explode('?', $url); //если в строке есть get параметры через ?
        
        // Если наш модуль административный
        $this->setCallFromAdmin($routes[0]);

        if (isset($this->_routeRuleArr) && is_array($this->_routeRuleArr))
        {
            $patternArr = array();
            $replacementArr = array();

            foreach ($this->_routeRuleArr as $key => $value)
            {
                array_push($patternArr, $key);
                array_push($replacementArr, $value);
            }

            $routes[0] = preg_replace($patternArr, $replacementArr, $routes[0]);
        }
        
        $this->parse($routes[0]);
    }

    private function parse($url)
    {
        Core::app()->echoPre($url);
        
        $routes = explode('/', $url);

        Core::app()->echoPre($routes);
        // Скорее всего нужно получить все языки, которые у нас установленны
        // и сравниваем языки с первой переменной. Если совпадает, то определили язык,
        // нет, значит ищем в сессии и куках, если там нет, то ставим по умолчанию и расцениваем, что это у нас модуль
        // Аналогичные проверки делаем для модуля
        // lang
        if (isset($routes[1]) && strlen($routes[1]) < 3 && count($routes) >= 4)
        {
            $this->_lang = $routes[1];
        }

        // module
        if (isset($routes[2]) && !$this->isEmpty($routes[2]))
        {
            $this->_module = $routes[2];
        }
        // controller
        if (isset($routes[3]) && !$this->isEmpty($routes[3]))
        {
            $this->_controller = $routes[3];
        }
        // action       
        if (isset($routes[4]) && !$this->isEmpty($routes[4]))
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

    public function getModuleName()
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

    public function getCallFromAdmin()
    {
        return $this->_callFromAdmin;
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