<?php

/**
 * Главный клас для всех моделей
 * @author Веталь
 * @version 1.0
 * @updated 17-Вер-2013 20:15:13
 */
class M_news_newsitems extends Model
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

    function getAllNewsItems()
    {
        $leftJoin = $this->_db->parse('LEFT JOIN  modules  ON news_items.id_module = modules.id');

        $fildsSelect = 'news_items.*, modules.id as id_module, modules.name as name_module, modules.name_system as name_system_module';


        return $this->selectAllFromTable('news_items', $fildsSelect, $leftJoin);
    }

    function getNewsItemById($id)
    {

        $leftJoin = $this->_db->parse('LEFT JOIN  modules  ON news_items.id_module = modules.id');

        $fildsSelect = 'news_items.*, modules.id as id_module, modules.name as name_module, modules.name_system as name_system';


        return $this->selectAllByIdFromTable('news_items', $id, $fildsSelect, $leftJoin);
    }

    function deleteNewsItemById($id)
    {
        $this->deleteTableRowById('news_items', $id);
    }    

    function deleteAllNewsItemsByModuleId($id)
    {
        $condition = $this->_db->parse('?n.?n = ?i','news_items','id_module' ,$id);
         
        $result = $this->deleteTableRowByCondition('news_items', $condition);
    }        
    
    function updateNewsitemById($id, $dataArr)
    {
        return $this->updateTableRowById('news_items', $id, $dataArr);
    } 
         
    function setNewsItem($dataArr)
    {
        $this->insertTableRow('news_items', $dataArr);
    }     
    
}

?>