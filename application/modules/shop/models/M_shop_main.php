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

    function getProductById($id, $is_active = null)
    {
        if ($is_active != null)
        {
            $is_active = $this->_db->parse('AND is_active = ?i', $is_active);
        }
        else
        {
            $is_active = '';
        }


        $sql = $this->_db->parse('
            SELECT *
            FROM shop_products 
            WHERE id = ?i 
            ?p
            ', $id, $is_active);

        $dataArrProduct = $this->_db->getRow($sql);

        $join = $this->_db->parse(' 
            WHERE ?n = ?i ',
            'id_product' , $id);
        $fildsSelect = '
            shop_products_img.id,
            shop_products_img.name 
            ';
        $dataArrProduct['images'] = $this->selectAllFromTable('shop_products_img', $fildsSelect, $join);

        $join = $this->_db->parse(' 
            WHERE ?n = ?i ',
            'id_product' , $id);
        $fildsSelect = '
            shop_products_category.id_category
            ';
        $dataArrProduct['selected_category'] = $this->selectAllFromTable('shop_products_category', $fildsSelect, $join);

        $join = $this->_db->parse(' 
            WHERE ?n = ?i ',
            'id_product' , $id);
        $fildsSelect = '
            shop_products_content.*
            ';
        $dataArrProduct['product_content'] = $this->selectAllFromTable('shop_products_content', $fildsSelect, $join);        

        $join = $this->_db->parse(' 
            WHERE ?n = ?i ',
            'id_product' , $id);
        $fildsSelect = '
            shop_products_price.*
            ';
        $dataArrProduct['product_price'] = $this->selectAllFromTable('shop_products_price', $fildsSelect, $join);        

        $join = $this->_db->parse(' 
            WHERE ?n = ?i ',
            'id_product' , $id);
        $fildsSelect = '
            shop_products_brand.*
            ';
        $dataArrProduct['product_brand'] = $this->selectAllFromTable('shop_products_brand', $fildsSelect, $join);        

        return $dataArrProduct;
    }

    public function getProductImgByid($id)
    {
        return $this->selectRowFromTableById('shop_products_img', $id);
    }

    public function getAllProductImgByProductId($id_product)
    {
        return $this->selectAllByIdFromTable('shop_products_img', $id_product, null, null, 'id_product');
    }            
    
    function getAllProducts($id_curr_lang, $limit = null)
    {

        $limit = '';
        if ($limit != null)
        {
            $limit = $this->_db->parse('LIMIT ?i', $limit);
        }

        $join = $this->_db->parse(' 
            LEFT JOIN shop_products_img ON shop_products_img.id = shop_products.id_main_img
            LEFT JOIN shop_products_content ON shop_products_content.id_product = shop_products.id 
            WHERE shop_products_content.id_lang = ?i
            ', $id_curr_lang);

        $fildsSelect = '
            shop_products.*,
            shop_products_content.title, 
            shop_products_content.preview, 
            
            shop_products_img.name as name_img,
            shop_products_content.id_lang
           
            ';
        $data = $this->selectAllFromTable('shop_products', $fildsSelect, $join);

        return $data;
    }

    function getShopSettingsByModuleId($id)
    {
        $data = $this->selectAllByIdFromTable('shop_module_settings', $id, null, null, 'id_module');
        return $data;
    }

    function getAllShopSettings()
    {
        $data = $this->selectAllFromTable('shop_module_settings');
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

    function updateProductContentById($id_product, $id_lang, $dataArr)
    {
        $id_lang = (int)$id_lang;
        
        $and = $this->_db->parse(' AND ?n = ?i', 'id_product', $id_product);
        
        $this->updateTableRowByCondition('shop_products_content', 'id_lang', $id_lang, $dataArr, $and);
    }
    
    function deleteNewsSettingsByModuleId($id)
    {
        $condition = $this->_db->parse('?n.?n = ?i', 'news', 'id_module', $id);

        $result = $this->deleteTableRowByCondition('news', $condition);
    }
      
    function deleteProductById($id_product)
    {
        $condition = $this->_db->parse('?n.?n = ?i', 'shop_products', 'id', $id_product);

        $result = $this->deleteTableRowByCondition('shop_products', $condition);
    }
      
    function deleteProductContentByProductId($id_product)
    {
        $condition = $this->_db->parse('?n.?n = ?i', 'shop_products_content', 'id_product', $id_product);

        $result = $this->deleteTableRowByCondition('shop_products_content', $condition);
    }
    
    function deleteAllProductImageByProductId($id_product)
    {
        $condition = $this->_db->parse('?n.?n = ?i', 'shop_products_img', 'id_product', $id_product);

        $result = $this->deleteTableRowByCondition('shop_products_img', $condition);
    }
    
    function deleteProductImageById($id_image_delete)
    {
        $condition = $this->_db->parse('?n.?n = ?i', 'shop_products_img', 'id', $id_image_delete);

        $result = $this->deleteTableRowByCondition('shop_products_img', $condition);
    }
    
    function deleteAllCategoriesByProductId($id_product)
    {
        $condition = $this->_db->parse('?n.?n = ?i', 'shop_products_category', 'id_product', $id_product);

        $result = $this->deleteTableRowByCondition('shop_products_category', $condition);
    }
    
    function checkProductContentByLangId($id_lang)
    {
        $join = $this->_db->parse('
            WHERE shop_products_content.id_lang = ?i
            ', $id_lang);

        $fildsSelect = '
            COUNT(*)
            ';
        $data = $this->selectAllFromTable('shop_products_content', $fildsSelect, $join);

        return $data[0]['COUNT(*)'];
    }

    
}

?>