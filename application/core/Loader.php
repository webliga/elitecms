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

    public function start()
    {
        Core::app()->getConfig()->loadConfig(PREFIX_CONFIG.'db');
        Core::app()->getConfig()->loadConfig(PREFIX_CONFIG.'default');

        Core::app()->getRoute()->run();
    }

}

?>