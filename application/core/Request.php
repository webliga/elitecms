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
	 * Обязательно переделать этот метод
	 */
    public function runParseUrl($url)
    {
        $this->_url = $url;
        $this->_lang = 'ru';
        $this->_module = 'main';
        $this->_controller = 'main';
        $this->_action = 'index';
       
       $routes = explode('/', $url);


       if(isset($routes[1])  && strlen($routes[1]) < 3 && count($routes) >= 4)
       {
            $this->_lang = $routes[1];
       }
       else
       {
            //Core::app()->getError()->errorPage404('5');
            return;
       }
       
       if(isset($routes[2]))
       {
            $this->_module = $routes[2];
       }       
       
       if(isset($routes[3]))
       {
            $this->_controller = $routes[3];
       }
              
       if(isset($routes[4]) && strlen($routes[4]) > 0)
       {
            $this->_action = $routes[4];
       }
       else
       {
            $this->_action = 'index';
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