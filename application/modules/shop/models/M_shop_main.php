<?php

/**
 * Главный клас для всех моделей
 * @author Веталь
 * @version 1.0
 * @updated 17-Вер-2013 20:15:13
 */
class M_shop_main extends Model
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

    public function insertProduct($dataArr)
    {
        $last_insert_id = $this->insertTableRow('shop_products', $dataArr);
        
        return $last_insert_id['last_insert_id()'];
    }

    public function insertProductContent($dataArr)
    {
        $last_insert_id = $this->insertTableRow('shop_products_content', $dataArr);
        
        return $last_insert_id['last_insert_id()'];
    }
    
    public function insertProductImg($dataArr)
    {
        $last_insert_id = $this->insertTableRow('shop_products_img', $dataArr);
        
        return $last_insert_id['last_insert_id()'];
    }            
    
    public function insertProductCategory($dataArr)
    {
        $last_insert_id = $this->insertTableRow('shop_products_category', $dataArr);
        
        return $last_insert_id['last_insert_id()'];
    }     
    
    function getProductById($id)
    {
        $sql = $this->_db->parse("
            SELECT *
            FROM shop_products 
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
    
    function getShopSettingsByModuleId($id)
    {
        $data = $this->selectAllByIdFromTable('shop_module_settings',$id , null, null, 'id_module');
        return $data;
    }
    
    function updateShopSettingsByModuleId($dataArr)
    {
        $id_module = $dataArr['id_module'];
        unset($dataArr['id_module']);
        
        $result = $this->updateTableRowByCondition('shop_module_settings', 'id_module', $id_module, $dataArr);        
    }
    
    function updateProductById($id, $dataArr)
    {
        $this->updateTableRowById('shop_products', $id, $dataArr);        
    }
    
    function deleteNewsSettingsByModuleId($id)
    {       
        $condition = $this->_db->parse('?n.?n = ?i','news','id_module' ,$id);
         
        $result = $this->deleteTableRowByCondition('news', $condition);        
    }   
}

?>