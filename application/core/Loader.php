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

    public function loadFile($path, $returnConfig = false)
    {
        if ($this->issetFile($path))
        {
            require_once $path;

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
        $template = Core::app()->getConfig()->getConfigItem('default_template');

        $path =
                PATH_SITE_ROOT .
                SD .
                $template['path'] .
                SD .
                $template['name'] .
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
        $template = Core::app()->getConfig()->getConfigItem('default_template');

        if(!isset($page) || $this->isEmpty($page))
        {
            $page = DEFAULT_PAGE_MAIN;
        }

        $path =
                PATH_SITE_ROOT .
                SD .
                $template['path'] .
                SD .
                $template['name'] .
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