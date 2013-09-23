<?php

// тут мы подгружаем данные из файла конфига. Эти данные можно будет перекрыть из настроек в БД

class Loader
{

    function __construct()
    {
        
    }

    function __destruct()
    {
        
    }

    public function loadClass($path)
    {
        if (file_exists($path))
        {
            require_once $path;
        }
        else
        {
            Core::app()->getError()->errorFileNotExist('Файл ' . $path . ' не существует!');
        }
    }

}

?>