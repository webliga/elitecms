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
        Core::app()->getConfig()->loadConfig('config_db');
        Core::app()->getConfig()->loadConfig('config_default');
        
        Core::app()->echoPre(Core::app()->getConfig()->getDataArrayConfig());
        
        
        Core::app()->appExit();
        Core::app()->getRoute()->run();
    }

}

?>