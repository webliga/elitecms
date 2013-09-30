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

    public function loadClass($path, $returnConfig = false)
    {
        if (file_exists($path))
        {
            require_once $path;
                      
            if($returnConfig)
            {
                return $config;
            }
            
            
        }
        else
        {
            Core::app()->getError()->errorFileNotExist('Файл ' . $path . ' не существует!');
        }
    }

}

?>