<?php

/**
 * Главный клас для всех моделей
 * @author Веталь
 * @version 1.0
 * @updated 17-Вер-2013 20:15:13
 */
class Model extends Base
{

    protected $_db ;

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

    public function selectAllFromTable($nameTable, $fildsSelect = null, $join = null)
    {
        if($this->isEmpty($fildsSelect) || is_null($fildsSelect))
        {
            $fildsSelect = '*';
        }
        
        $sql = $this->_db->parse('SELECT ' . $fildsSelect . '  FROM ?n ?p',$nameTable, $join);
        
        
        $data = $this->_db->getAll($sql);
        
        return $data;
    }

    public function selectAllByIdFromTable($nameTable, $id, $fildsSelect = null, $join = null)
    {
        if($this->isEmpty($fildsSelect) || is_null($fildsSelect))
        {
            $fildsSelect = '*';
        }
        
        $sql = $this->_db->parse('SELECT ' . $fildsSelect . ' FROM ?n ?p WHERE ?n.id=?i',$nameTable, $join,$nameTable , $id);

        $data = $this->_db->getRow($sql);
        
        return $data;
    }

    public function updateTableRowById($nameTable, $id, $dataArr)
    {        
        $sql = $this->_db->parse("UPDATE ?n SET ?u WHERE id = ?i"  ,$nameTable , $dataArr, $id);
        
        $this->_db->query($sql);
    }    
    

    public function insertTableRow($nameTable, $dataArr)
    {        
        $sql = $this->_db->parse("INSERT INTO ?n SET ?u "  ,$nameTable , $dataArr);

        $this->_db->query($sql);
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

    public function selectConfig()
    {
        $query = "SELECT 
                  modules.id as module_id, 
                  modules.name as name,                 
                  modules.name_system as name_system,
                  modules.template_file as template_file,                  
                  position.name as position_name,
                  position.name_system as position_name_system,
                  position_modules.priority as position_priority
            FROM modules 
                  LEFT JOIN  position_modules   ON modules.id = position_modules.module_id
                  LEFT JOIN  position  ON position_modules.position_id = position.id
                ";
        
        $data = $this->_db->getAll($query);
        return $data;
        
    }
}

?>