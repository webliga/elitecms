<?php

/**
 * Класс который отвечает за запросы
 * @author Веталь
 * @version 1.0
 * @updated 17-Вер-2013 20:15:13
 */
class Request extends Base
{

    private $_allLang = null;
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
            
            $this->_post = Core::app()->getSecure()->checkGetPost($_POST);
            $_POST = null;
        }

        if (isset($_GET))
        {// Можно проверку сделать
            $this->_get = Core::app()->getSecure()->checkGetPost($_GET);
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
        $routes = explode('/', $url);

        $module = '';

        if (isset($routes[1]))
        {
            // Если первый параметр язык, тогда проверяем второй
            // если он есть, то это модуль
            // если его нету, то значит это не админка
            if (in_array(mb_strtolower($routes[1]), $this->_allLang))
            {
                if(isset($routes[2]))
                {
                    $module = $routes[2];
                }
            }
            else
            {
                $module = $routes[1];
            }
        }

        if (!$this->isEmpty($module))
        {
            $path_module_config =
                    PATH_SITE_ROOT .
                    SD .
                    PATH_TO_MODULES .
                    SD .
                    $module .
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
        $this->_allLang = Core::app()->getConfig()->getAllLang();

        // Ставим путь по умолчанию
        $this->_url = $url;
        $this->_lang = $configDefaultLang['name'];
        $this->_module = $configDefaultUrl['name'];
        $this->_controller = $configDefaultUrl['controller'];
        $this->_action = $configDefaultUrl['action'];

        $routes = explode('?', $url); //если в строке есть get параметры через ?
        // Если наш модуль административный
        $this->setCallFromAdmin($url);

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

        $routes = explode('/', $url);

        $moduleInstall = false;
        $controllerInstall = false;
        $actionInstall = false;
        $canGetParameters = false;
        $keyParam = true;

        //Core::app()->echoPre($routes);
        // Скорее всего нужно получить все языки, которые у нас установленны
        // и сравниваем языки с первой переменной. Если совпадает, то определили язык,
        // нет, значит ищем в сессии и куках, если там нет, то ставим по умолчанию и расцениваем, что это у нас модуль
        // Аналогичные проверки делаем для модуля
        // lang

        for ($i = 1; $i < count($routes); $i++)
        {
            // Если это первый параметр
            if ($i == 1 && !$this->isEmpty($routes[$i]))
            {// Если нашли наш язык
                if (in_array(mb_strtolower($routes[$i]), $this->_allLang))
                {
                    $this->_lang = $routes[$i];
                }
                else
                {
                    // Если язык не нашли, то значит это модуль,
                    // по умолчанию язык уже установлен
                    $this->_module = $routes[$i];
                    $moduleInstall = true;
                }
            }

            if ($i == 2 && !$this->isEmpty($routes[$i]))
            {
                if (!$moduleInstall)
                {
                    $this->_module = $routes[$i];
                    $moduleInstall = true;
                }
                else
                {
                    $this->_controller = $routes[$i];
                    $controllerInstall = true;
                }
            }

            if ($i == 3 && !$this->isEmpty($routes[$i]))
            {
                if (!$controllerInstall)
                {
                    $this->_controller = $routes[$i];
                    $controllerInstall = true;
                }
                else
                {
                    $this->_action = $routes[$i];
                    $actionInstall = true;
                }
            }

            if ($i == 4 && !$this->isEmpty($routes[$i]))
            {
                $canGetParameters = true;

                if (!$actionInstall)
                {
                    $this->_action = $routes[$i];
                    continue;
                }
            }

            if ($canGetParameters)
            {
                if ($keyParam)
                {
                    if($this->isEmpty($routes[$i]))
                    {
                        break;
                    }

                    $this->_params[$routes[$i]] = '';
                    $keyParam = false;
                }
                else
                {
                    $this->_params[$routes[$i - 1]] = $routes[$i];
                    $keyParam = true;
                }
            }
        }
/*
        Core::app()->echoPre($this->_lang);
        Core::app()->echoPre($this->_module);
        Core::app()->echoPre($this->_controller);        
        Core::app()->echoPre($this->_action);
        Core::app()->echoPre($this->_params);*/
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