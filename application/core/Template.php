<?php

/**
 * Главный класс для всех контроллеров
 * @author Веталь
 * @version 1.0
 * @updated 17-Вер-2013 23:02:27
 */
class Template extends Base
{

    public $_data;
    private $_nameTemplate = '';
            
    function __construct()
    {
        parent::__construct();
    }

    function __destruct()
    {
        
    }

    public function setVar($nameVar, $dataVar)
    {
        $this->_data[$nameVar] = $dataVar;
    }

    public function getRenderedHtml($pathToTemplate, $data)
    {
        $content = '';
        
        return $content;
    }

    public function show()
    {
 
        Core::app()->getLoader()->loadTemplate();
    }

    public function showBlock($nameBlock)
    {
        Core::app()->getLoader()->loadTemplateBlock($nameBlock);
    }
}

?>