<?php


class Config
{
    
    private $_data = array();
       
	public function __construct()
	{
     
       
	}

	public function __destruct()
	{
	} 
       
	public  function setConfigItem($key, $item)
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
       
	public  function getConfigItem($key)
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