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
        $leftJoin = $this->_db->parse('LEFT JOIN  category_items  ON 
                                       news_items.id_category_items = category_items.id'
                                      );

        $fildsSelect = 'news_items.*, 
                        category_items.id as id_category_items, 
                        category_items.name as name_category_items';


        return $this->selectAllFromTable('news_items', $fildsSelect, $leftJoin);
    }

    function getAllNewsItemsByCategory($cat_id, $limit = 1000)
    {
        $leftJoin = $this->_db->parse('LEFT JOIN  category_items  ON 
                                       news_items.id_category_items = category_items.id 
                                       WHERE ?n = ?i LIMIT ?i', 'id_category_items', $cat_id, $limit
                                      );

        $fildsSelect = 'news_items.*, 
                        category_items.id as id_category_items, 
                        category_items.name as name_category_items';


        return $this->selectAllFromTable('news_items', $fildsSelect, $leftJoin);
    }
    
    function getNewsItemById($id)
    {

        $leftJoin = $this->_db->parse('LEFT JOIN  category_items  ON 
                                       news_items.id_category_items = category_items.id'
                                      );

        $fildsSelect = 'news_items.*, 
                        category_items.id as id_category_items, 
                        category_items.name as name_category_items';


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