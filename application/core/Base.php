<?php


	/**
	 * Это главный абстрактный клас от которого будут наследоваться все класы движка
	 * @author Веталь
	 * @version 1.0
	 * @updated 18-Вер-2013 3:40:40
	 */
abstract class Base
{
	function __construct()
	{

	}

	function __destruct()
	{
	}

	/**
	 * Возвращает имя класа
	 */
	public function getClassName()
	{
	   return get_class($this);
	}	
        
        public function isEmpty($var)
        {
            $empty = true;
            
            if(isset($var) && $var != null && $var != '' && $var != ' ')
            {
                $empty = false;
            }
            
            return $empty;
        }
}
?>