<?php

/**
 * Класс вывода ошибок
 * @author Веталь
 * @version 1.0
 * @created 17-Вер-2013 20:21:07
 */
class Error
{
	function __construct()
	{
	}

	function __destruct()
	{
	}
    
	/**
	 * Выводит ошибку 404
	 */
	public function errorPage404($err)
	{
	   Core::app()->echoEcho('errorPage404 '.$err);
	    /*         
		$host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:'.$host.'404');*/
        Core::app()->appExit();
	}

}
?>