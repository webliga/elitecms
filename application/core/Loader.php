<?php

// тут мы подгружаем данные из файла конфига. Эти данные можно будет перекрыть из настроек в БД

class Loader extends Base
{

    function __construct()
    {
        
    }

    function __destruct()
    {
        
    }

    public function loadFile($path, $returnConfig = false, $once = true)
    {
        if ($this->issetFile($path))
        {
            if($once)
            {
                require_once $path;
            }
            else
            {
                require $path;
            }

            if ($returnConfig)
            {
                return $config;
            }
        }
        else
        {
            // Если возвращаем масив конфигураций и файла конфигураций небыло, то ошибку не выводим
            if(!$returnConfig)
            {
                Core::app()->getError()->errorFileNotExist('Файл ' . $path . ' не существует!');
            }
        }
    }      
    
    public function loadTemplateBlock($nameBlock)
    {
        $templateName = Core::app()->getTemplate()->getCurrentTemplatePath(true);

        $path =
                $templateName .
                SD .
                'blocks' .
                SD .
                PFX_BLOCK . 
                $nameBlock . EXT_TEMPLATE_FILE;

        if ($this->issetFile($path))
        {
            $arrData = Core::app()->getTemplate()->_data;
            if (is_array($arrData))
            {
                extract($arrData);
            }

            require $path;
        }
        else
        {
            Core::app()->getError()->errorFileNotExist('Блок ' . $nameBlock . ' не существует!');
        }
    }

    public function loadTemplate($page = null)
    {
        $templateName = Core::app()->getTemplate()->getCurrentTemplatePath(true); 
        
        if(!isset($page) || $this->isEmpty($page))
        {
            $page = DEFAULT_PAGE_MAIN;
        }

        $path =
                $templateName .
                SD .
                'pages' .
                SD .
                $page;
        
        
        if ($this->issetFile($path))
        {
            require_once $path;
        }
        else
        {
            Core::app()->getError()->errorFileNotExist('Блок ' . $nameBlock . ' не существует!');
        }
    }


}

?>