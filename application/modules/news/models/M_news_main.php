<?php

/**
 * Главный клас для всех моделей
 * @author Веталь
 * @version 1.0
 * @updated 17-Вер-2013 20:15:13
 */
class M_news_main extends Model
{

    public $_name_model;

    function __construct()
    {
        parent::__construct();

        $this->_name_model = $this->getClassName();
    }

    function __destruct()
    {
        
    }

    function getNewsById($id)
    {
        $sql = $this->_db->parse("
            SELECT *
            FROM news_items 
            WHERE id = ?i 
            AND is_active = 1", $id);

        $data = $this->_db->getRow($sql);

        return $data;
    }

    function getNews($limit)
    {
        $join = $this->_db->parse('WHERE ?n = 1  ORDER BY date_create ASC LIMIT ?i', 'is_active', $limit );
        $data = $this->selectAllFromTable('news_items', null, $join);
        
        return $data;
    }
    
    function getNewsSettingsByModuleId($id)
    {
        $data = $this->selectAllByIdFromTable('news',$id , null, null, 'id_module');
        return $data;
    }
    
    function updateNewsSettingsByModuleId($dataArr)
    {
        $id_module = $dataArr['id_module'];
        unset($dataArr['id_module']);
        
        $result = $this->updateTableRowByCondition('news', 'id_module', $id_module, $dataArr);        
    }
    
    function deleteNewsSettingsByModuleId($id)
    {       
        $condition = $this->_db->parse('?n.?n = ?i','news','id_module' ,$id);
         
        $result = $this->deleteTableRowByCondition('news', $condition);        
    }   
}

?>