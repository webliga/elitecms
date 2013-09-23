<?php


	/**
	 * Класс который отвечает за запросы
	 * @author Веталь
	 * @version 1.0
	 * @updated 17-Вер-2013 20:15:13
	 */
class Request
{
    private $_lang;    
    
    private $_module;
    
    private $_controller;

    private $_action;

    private $_params;
    
    private $_url;

	function __construct()
	{
	}

	function __destruct()
	{
	}
	/**
	 * Обязательно переделать этот метод, нет нормального разбора урл
	 */
    public function runParseUrl($url)
    {
        $congiDefaultUrl = Core::app()->getConfig()->getConfigItem('default_module');
        $congiDefaultLang = Core::app()->getConfig()->getConfigItem('default_lang');        
        
        Core::app()->echoPre($congiDefaultUrl);
        // Ставим путь по умолчанию
        $this->_url = $url;
        $this->_lang = $congiDefaultLang['name'];
        $this->_module = $congiDefaultUrl['name'];
        $this->_controller = $congiDefaultUrl['controller'];
        $this->_action = $congiDefaultUrl['action'];;
       
       $routes = explode('/', $url);

       // lang
       if(isset($routes[1])  && strlen($routes[1]) < 3 && count($routes) >= 4)
       {
            $this->_lang = $routes[1];
       }
       else
       {
            //Core::app()->getError()->errorPage404('5');
            return;
       }
       // module
       if(isset($routes[2]))
       {
            $this->_module = $routes[2];
       }       
       // controller
       if(isset($routes[3]))
       {
            $this->_controller = $routes[3];
       }
       // action       
       if(isset($routes[4]) && strlen($routes[4]) > 0)
       {
            $this->_action = $routes[4];
       }
       else
       {
            $this->_action = DEFAULT_ACTION;
       }      
    }

	public function getLang($lang = null) 
    {
        if($lang != null)
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

}
?>