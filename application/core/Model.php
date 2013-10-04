<?php

/**
 * Главный клас для всех моделей
 * @author Веталь
 * @version 1.0
 * @updated 17-Вер-2013 20:15:13
 */
class Model extends Base
{

    private $_db = '1';
    private $_conn;
    private $_stats;
    private $_emode;
    private $_exname;
    private $_configDb = array();

    const RESULT_ASSOC = MYSQLI_ASSOC;
    const RESULT_NUM = MYSQLI_NUM;

    function __construct($optionals = null)
    {
        parent::__construct();

        if ($optionals == null || !is_array($optionals))
        {
            $optionals = Core::app()->getConfig()->getConfigItem('db');
        }

        $optionals = array_merge($this->_configDb, $optionals);

        //$this->emode = $optionals['errmode'];
        //$this->exname = $optionals['exception'];

        if ($optionals['db_pconnect'])
        {
            $optionals['db_host'] = "p:" . $optionals['db_host'];
        }

        @$this->conn = mysqli_connect($optionals['db_host'], $optionals['db_user'], $optionals['db_pass'], $optionals['db_name'], $optionals['db_port'], $optionals['db_socket']);
        if (!$this->conn)
        {
            Core::app()->getError()->errorDbConnect(mysqli_connect_errno() . " " . mysqli_connect_error());
        }
        else
        {
            mysqli_set_charset($this->conn, $optionals['db_charset']) or Core::app()->getError()->errorDbConnect(mysqli_error($this->conn));
        }

        unset($optionals); // I am paranoid
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

    public function insert()
    {
        
    }

    public function select()
    {
        
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