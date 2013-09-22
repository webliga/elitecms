<?php

	/**
	 * Класс отвечающий за безопасность
	 * @author Веталь
	 * @version 1.0
	 * @updated 17-Вер-2013 20:15:13
	 */
class Secure
{

	function __construct()
	{
	  // echo 'Secure__construct()<br>';
	}

	function __destruct()
	{
	}

	/**
	 * Проверяет урл на валидность. Возвращает масив с разбитым урлом по модулям,
	 * контроллере, екшине и языку
	 * 
	 * @param url
	 */
	public function validate_url($url)
	{
       return $url;
	}

}
?>