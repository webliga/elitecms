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
                    SD .
                    PATH_TO_LIB .
                    SD .
                    $nameClass .
                    '.php';

            Core::app()->getLoader()->loadFile($path);
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
        
        $result = $this->_db->getAll($sql);
        
        return $result;
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
        $sql = $this->_db->parse('SELECT ?p FROM ?n ?p WHERE ?n.?n=?i', $fildsSelect, $nameTable, $join,$nameTable, $fildWhere, $id);

        $result = $this->_db->getRow($sql);
        
        return $result;
    }

    public function updateTableRowById($nameTable, $id, $dataArr)
    {        
        $sql = $this->_db->parse("UPDATE ?n SET ?u WHERE id = ?i"  ,$nameTable , $dataArr, $id);
        
        $this->_db->query($sql);
    }    

    public function updateTableRowByCondition($nameTable, $fildTableNameCondition = null, $fildTableValueCondition, $dataArr)
    {        
        if($fildTableNameCondition == null)
        {
            $fildTableNameCondition = 'id';
        }
        
        $sql = $this->_db->parse("UPDATE ?n SET ?u WHERE ?n = ?i"  , $nameTable, $dataArr, $fildTableNameCondition, $fildTableValueCondition);
        
        $this->_db->query($sql);
    }     

    public function insertTableRow($nameTable, $dataArr)
    {        
        $sql = $this->_db->parse("INSERT INTO ?n SET ?u " ,$nameTable , $dataArr);
        $this->_db->query($sql);
        
        $sql = 'select last_insert_id()';
        $result = $this->_db->getRow($sql);
        
        return $result;
    }     
    
    public function update()
    {
        
    }

    public function deleteTableRowById($nameTable, $id)
    {
        $sql = $this->_db->parse('DELETE FROM ?n  WHERE id = ?i',$nameTable , $id);
        $this->_db->query($sql);
    }

    public function deleteTableRowByCondition($nameTable, $condition)
    {
        $sql = $this->_db->parse('DELETE FROM ?n  WHERE ?p',$nameTable , $condition);

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
        //Выбираем главные настройки
         //Выбираем настройки модулей
        $querySettings = "
            SELECT 
                  settings.*
            FROM settings 
                ";
        
        $arr = $this->_db->getAll($querySettings);//$this->echoPre($result2);       
        $settings = null;
        for($i = 0;$i < count($arr);$i++)
        {
            $settings[$arr[$i]['name']] = $arr[$i]['value'];
        }

        $result['settings'] = $settings;
        
        //Выбираем настройки модулей
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
            WHERE modules.is_active = 1
                ";
        
        $result['modules'] = $this->_db->getAll($query);

        return $result;
        
    }
}

?>