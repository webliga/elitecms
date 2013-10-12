<?php



	/**
	 * Класс обертка для работы со строками(кодировка, проверка грамматики и прочее).
	 */
class Grammatical extends Base
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