<?php

Core::app()->getConfig()->setConfigItem('site',$config); 

class Loader
{    
	function __construct()
	{
        
	}

	function __destruct()
	{
	}

	public function start()
	{
       Core::app()->getRoute()->run();
	}
}
?>