<?php
	/**
	 * Главный клас модуля, все запросы по умолчанию отправляются сюда
	 * @author Веталь
	 * @version 1.0
	 * @updated 17-Вер-2013 20:15:13
	 */
class C_shop extends Controller
{

	function __construct()
	{
	   parent::__construct();
	}

	function __destruct()
	{
	}

	/**
	 * Действие по умолчанию
	 */
	public function index()
	{       
       $this->loadModel('M_main', $this->getNameModule());       
       $this->loadModel('M_shop', $this->getNameModule());
       $this->loadModel('M_user', $this->getNameModule('user'));       
       
       Core::app()->echoEcho($this->mainM_main->_name_model);
       Core::app()->echoEcho($this->mainM_shop->_name_model);
       Core::app()->echoEcho($this->userM_user->_name_model);

	}

}
?>