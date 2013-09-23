<?php

class Config
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
                SEPARATOR .
                PATH_TO_CONFIG .
                SEPARATOR .
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

}

?>