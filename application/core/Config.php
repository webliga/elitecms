<?php

class Config extends Base
{

    private $_data;

    public function __construct()
    {
        
    }

    public function __destruct()
    {
        
    }

    public function loadConfig($fileName)
    {
        $path_to_config =
                PATH_SITE_ROOT .
                SD .
                PATH_TO_CONFIG .
                SD .
                $fileName . '.php';

        if (file_exists($path_to_config))
        {
            require_once $path_to_config;
        }
        else
        {
            return false;
        }

        if (is_array($this->_data) && is_array($config))
        {
            foreach ($config as $key => $value)
            {
                $this->_data[$key] = $value;
            }
        }
        else
        {
            $this->_data = $config;
        }

        return true;
    }

    public function setConfigItem($key, $item)
    {
        if (!array_key_exists($key, $this->_data))
        {
            foreach ($this->_data as $val)
            {
                if ($val === $item)
                {
                    return false;
                }
            }
        }
        $this->_data[$key] = $item;

        return true;
    }

    public function getConfigItem($key)
    {

        if (array_key_exists($key, $this->_data))
        {
            return $this->_data[$key];
        }

        return null;
    }

    /**
     * 
     * @param key
     */
    public function removeConfigItem($key)
    {
        if (array_key_exists($key, $this->_data))
        {
            unset($this->_data[$key]);
        }
    }

    public function getDataArrayConfig()
    {
        return $this->_data;
    }

    public function selectSystemConfig($url)
    {
        $model = new Model();

        $result = $model->selectConfig();

        
        if (!isset($result['settings']['template_main']) || $this->isEmpty($result['settings']['template_main']))
        {
            $template = Core::app()->getConfig()->getConfigItem('default_template');
            Core::app()->getTemplate()->setMainTemplateName($template['name']);
        }
        else
        {
            Core::app()->getTemplate()->setMainTemplateName($result['settings']['template_main']);
        }

        if (!isset($result['settings']['template_admin']) || $this->isEmpty($result['settings']['template_admin']))
        {
            // Если в настройках нету указано шаблона для админки, то ставим тот что на сайте
            $template = Core::app()->getTemplate()->getCurrentTemplateName();
            Core::app()->getTemplate()->setAdminTemplateName($template);
        }
        else
        {
            Core::app()->getTemplate()->setAdminTemplateName($result['settings']['template_admin']);
        }


        $this->setConfigItem('modules', $result['modules']);
        $this->setConfigItem('settings', $result['settings']);

        //$this->echoPre($this->_data);
    }

    public function getAllModulesRouteRule()
    {
        $result = null;

        $dir = 
                PATH_SITE_ROOT . 
                SD . 
                PATH_TO_MODULES;
        
        $loader = Core::app()->getLoader();

        $modulesDirArr = scandir($dir);


        foreach ($modulesDirArr as $key => $value)
        {
            if ($value != '..' && $value != '.')
            {
                $mConfig = $dir . SD . $value . SD . 'config' . SD . PFX_CONFIG . 'route.php';
                $arr = $loader->loadFile($mConfig, true);

                if (isset($arr) && is_array($arr))
                {
                    foreach ($arr as $key => $value)
                    {
                        $result[$key] = $value;
                    }
                }
            }
        }

        return $result;
    }

    public function getAllModulesConfig()
    {
        $result = null;

        $dir = PATH_SITE_ROOT . SD . PATH_TO_MODULES;
        $loader = Core::app()->getLoader();

        $modulesDirArr = scandir($dir);


        foreach ($modulesDirArr as $key => $value)
        {
            if ($value != '..' && $value != '.')
            {
                $mConfig = $dir . SD . $value . SD . 'config' . SD . PFX_CONFIG . 'main.php';
                $arr = $loader->loadFile($mConfig, true, false);

                if (isset($arr) && is_array($arr))
                {
                    $result[$value] = $arr;
                }
            }
        }

        return $result;
    }
    
    public function getAllLang()
    {
        $langArr = array();
        $path_to_lang =
                PATH_SITE_ROOT .
                SD .
                PATH_TO_LANG;

        if (is_dir($path_to_lang))
        {
            $arr = scandir($path_to_lang);

            for ($i = 0; $i < count($arr); $i++)
            {
                $dir = $path_to_lang .
                        SD .
                        $arr[$i];

                if (!is_dir($dir) && $arr[$i] != '.' && $arr[$i] != '..')
                {                   
                    $langArr[] = substr($arr[$i], 0, strrpos($arr[$i], '.'));
                }
            }
        }

        return $langArr;
    }

}

?>