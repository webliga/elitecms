<?php

/**
 * Главный клас для всех моделей
 * @author Веталь
 * @version 1.0
 * @updated 17-Вер-2013 20:15:13
 */
class Model extends Base
{

    private $_db ;

    function __construct($optionals = null)
    {
        parent::__construct();

        if ($optionals == null || !is_array($optionals))
        {// Подключаемся к дефолтным настройкам
            $optionals = Core::app()->getConfig()->getConfigItem('db');

            $nameClass = 'SafeMySQL';
            $path =
                    PATH_SITE_ROOT .
                    SEPARATOR .
                    PATH_TO_LIB .
                    SEPARATOR .
                    $nameClass .
                    '.php';

            Core::app()->getLoader()->loadClass($path);
            $this->_db = new $nameClass($optionals);
        }
    }

    function __destruct()
    {
        
    }

    public function connectToDb($name)
    {
        $this->_db .= $name;
    }

    public function getDb()
    {
        return $this->_db;
    }

    public function getTestName()
    {
        return 'test name from parent Model';
    }

    public function insert($sql)
    {
        
    }

    public function select($nameTable)
    {
        $data = $this->_db->getAll("SELECT * FROM ?n ",$nameTable);
        return $data;
    }

    public function update()
    {
        
    }

    public function delete()
    {
        
    }

    public function where()
    {
        
    }

    public function ore()
    {
        
    }

    public function orderBy()
    {
        
    }

    public function groupBy()
    {
        
    }

}

?>