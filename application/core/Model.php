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

    public function selectAllByIdFromTable($nameTable, $id, $fildsSelect = null, $join = null, $fildWhere = null)
    {
        if($this->isEmpty($fildsSelect) || is_null($fildsSelect))
        {
            $fildsSelect = '*';
        }
        if($this->isEmpty($fildWhere) || is_null($fildWhere))
        {
            $fildWhere = 'id';
        }        
        $sql = $this->_db->parse('SELECT ' . $fildsSelect . ' FROM ?n ?p WHERE ?n.?n=?i',$nameTable, $join,$nameTable, $fildWhere, $id);

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
        $sql = $this->_db->parse("INSERT INTO ?n SET ?u " ,$nameTable , $dataArr);
        $this->_db->query($sql);
        
        $sql = 'select last_insert_id()';
        $data = $this->_db->getRow($sql);
        
        return $data;
    }     
    
    public function update()
    {
        
    }

    public function deleteTableRowById($nameTable, $id)
    {
        $sql = $this->_db->parse('DELETE FROM ?n  WHERE id = ?i',$nameTable , $id);
        $this->_db->query($sql);
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
                  modules.id as id_module, 
                  modules.name as name,                 
                  modules.name_system as name_system,
                  modules.description as description,                  
                  positions.name as position_name,
                  positions.name_system as position_name_system,
                  position_modules.priority as position_priority
            FROM modules 
                  LEFT JOIN  position_modules   ON modules.id = position_modules.id_module
                  LEFT JOIN  positions  ON position_modules.id_position = positions.id
                ";
        
        $data = $this->_db->getAll($query);
        return $data;
        
    }
}

?>