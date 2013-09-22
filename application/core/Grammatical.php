<?php



	/**
	 * Класс обертка для работы со строками(кодировка, проверка грамматики и прочее).
	 */
class Grammatical
{
	function __construct()
	{

	}

	function __destruct()
	{
	}

	public function tolower($str)
	{
	   return mb_strtolower($str);
	}		
}
?>