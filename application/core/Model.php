<?php

	/**
	 * Главный клас для всех моделей
	 * @author Веталь
	 * @version 1.0
	 * @updated 17-Вер-2013 20:15:13
	 */
class Model extends Base
{

	function __construct()
	{
	   parent::__construct();
	}

	function __destruct()
	{
	}

    public function getTestName()
    {
        return 'test name from parent Model';
    }

}
?>