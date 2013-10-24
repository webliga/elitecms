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

    public function loadClass($path, $returnConfig = false)
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
            Core::app()->getError()->errorFileNotExist('Файл ' . $path . ' не существует!');
        }
    }

    public function loadTemplateBlock($nameBlock)
    {
        $template = Core::app()->getConfig()->getConfigItem('default_template');

        $path =
                PATH_SITE_ROOT .
                SEPARATOR .
                $template['path'] .
                SEPARATOR .
                $template['name'] .
                SEPARATOR .
                'blocks' .
                SEPARATOR .
                'block_' . $nameBlock . '.php';

        if ($this->issetFile($path))
        {
            $arrData = Core::app()->getTemplate()->_data;
            if (is_array($arrData))
            {
                extract($arrData);
            }

            require_once $path;
        }
        else
        {
            Core::app()->getError()->errorFileNotExist('Блок ' . $nameBlock . ' не существует!');
        }
    }

    public function loadTemplate()
    {
        $template = Core::app()->getConfig()->getConfigItem('default_template');

        //Core::app()->getTemplate()->setMainTemplateName($template['name']);
        
        $path =
                PATH_SITE_ROOT .
                SEPARATOR .
                $template['path'] .
                SEPARATOR .
                $template['name'] .
                SEPARATOR .
                'index.tpl.php';

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